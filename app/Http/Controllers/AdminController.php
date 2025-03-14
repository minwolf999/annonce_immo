<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppartmentRequest;
use App\Http\Requests\OptionRequest;
use App\Models\Appartment;
use App\Models\Image;
use App\Models\Options;
use Illuminate\Http\Request;
use Storage;

class AdminController extends Controller
{
    public function property()
    {
        $appartments = Appartment::all();

        return view('admin.property', [
            'appartments' => $appartments,
        ]);
    }

    public function new_property()
    {
        return view('admin.property_form', [
            'appartment' => new Appartment(),
            'options' => Options::all(),
        ]);
    }

    public function create_property(AppartmentRequest $request)
    {
        $extractedData = $this->extractData(new Appartment(), $request);
        $appartment = Appartment::create($extractedData);
        $appartment->options()->sync($request->validated('options'));
        
        if ($request->validated('images'))
        {
            $appartment->images()->sync($extractedData['image']);
        }

        return redirect()->route('admin.property')->with('success', 'L\'annonce a bien été créer');
    }

    public function modificate_property(Appartment $appartment)
    {
        return view('admin.property_form', [
            'appartment' => $appartment,
            'options' => Options::all(),
        ]);
    }

    public function property_modificate(Appartment $appartment, AppartmentRequest $request)
    {
        $extractedData = $this->extractData($appartment, $request);
        $appartment->update($extractedData);
        $appartment->options()->sync($request->validated('options'));

        if ($request->validated('images'))
        {
            $appartment->images()->sync($extractedData['image']);
        }

        return redirect()->route('admin.property')->with('success', 'L\'annonce a bien été modifier');
    }

    public function delete_property(Appartment $appartment)
    {
        $appartment->delete();

        return redirect()->route('admin.property')->with('success', 'L\'annonce a bien été supprimer');
    }

    public function option()
    {
        return view('admin.option', [
            'options' => Options::all(),
        ]);
    }

    public function new_option()
    {
        return view('admin.option_form', [
            'option' => new Options(),
        ]);
    }

    public function create_option(OptionRequest $request)
    {
        Options::create($request->validated());

        return redirect()->route('admin.option')->with('success', 'L\'option a bien été créer');
    }

    public function modificate_option(Options $options)
    {
        return view('admin.option_form', [
            'option' => $options,
        ]);
    }

    public function option_modificate(options $options, OptionRequest $request)
    {
        $options->update($request->validated());

        return redirect()->route('admin.option')->with('success', 'L\'option a bien été modifier');
    }

    public function delete_option(Options $options)
    {
        $options->delete();

        return redirect()->route('admin.option')->with('success', 'L\'option a bien été supprimer');
    }

    public function delete_image(Appartment $appartment, Image $image)
    {
        Storage::disk('public')-> delete($image->path);
        $image->delete();
        
        return to_route('admin.modificate_property', [
            'appartment' => $appartment,
        ]);
    }

    private function extractData (Appartment $appartment, AppartmentRequest $request): array
    {
        $data = $request->validated();
        /** @var \Illuminate\Http\UploadedFile|null $image */
        $images = $request->validated('images');

        if (!$images) {
            return $data;
        }

        $all_images = $appartment->images()->pluck('id')->toArray();

        foreach ($images as $image) {
            if ($image === null || $image->getError()) {
                break;
            }
    
            $image = Image::create([
                "path" => $image->store('appartment', 'public')
            ]);

            array_push($all_images, $image->id);
        }

        if (count($all_images) != 0)
        {
            $data['image'] = $all_images;
        }

        return $data;         
    }
}
