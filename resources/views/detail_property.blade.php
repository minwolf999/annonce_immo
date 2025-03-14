@extends('base')

@section('title', $appartment->titre)

@section('content')
    @php
        $options = $appartment->options()->get(['id', 'name']);
        $images = $appartment->images()->get(['id', 'path']);
    @endphp
    
    <div class="property_div" style="display: flex; gap: 30px; margin-top: 20px">
        <div style="width: 50%;">
            <div class="slideshow-container">

                @foreach ($images as $image)
                    <div class="mySlides fade">
                        <img src="{{ Request::root() }}/storage/{{ $image->path }}" style="width:100%">
                    </div>
                @endforeach

                @if (count($images) > 1)
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                @endif
            </div>

            <pre style="">{{ $appartment->description }}</pre>
        </div>

        <div>
            <h1 style="font-weight: 100; font-size: 40px">{{ $appartment->titre }}</h1>
            <h2 style="font-weight: 100">{{ $appartment->piece }} pièces - {{ $appartment->surface }}m<sup>2</sup></h2>

            <h1 style="font-size: 40px; color: blue;">{{ $appartment->price }} €</h1>

            <hr style="color: rgb(255, 255, 255);">

            <h3>Intéressé par ce biens ?</h3>

            <!-- <form action="" method="post"> -->
            <div class="form">
                <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name" style="border-radius: 5px;">
    
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
    
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name" style="border-radius: 5px;">
    
                        @error('last_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="phone">Téléphone</label>
                        <input type="tel" name="phone" id="phone" style="border-radius: 5px;">
    
                        @error('phone')
                            {{ $message }}
                        @enderror
                    </div>
    
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" style="border-radius: 5px;">
    
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="content" style="margin: 0 20px">Message</label>
                    <textarea name="content" id="content" style="height: 100px; resize: none; margin: 0 10px;de border-radius: 5px;"></textarea>

                    @error('content')
                        {{ $message }}
                    @enderror
                </div>

                <button class="bg-blue" style="margin: 0 20px;">Nous contacter</button>
            <!-- </form> -->
            </div>
        </div>
    </div>

    <div class="property_div" style="display: flex; gap: 30px; margin-top: 20px">
        <div style="width: 60%">
            <h3>Caractéristiques</h3>
            
            <table cellspacing="0" cellpadding="0">
               <tbody>
                    <tr>
                        <th>Surface habitable</th>
                        <td style="text-align: right;">{{ $appartment->surface }}m<sup>2</sup></td>
                    </tr>

                    <tr>
                        <th>Pièces</th>
                        <td style="text-align: right;">{{ $appartment->piece }}</td>
                    </tr>

                    <tr>
                        <th>Chambres</th>
                        <td style="text-align: right;">{{ $appartment->bedroom }}</td>
                    </tr>

                    <tr>
                        <th>Étages</th>
                        <td style="text-align: right;">{{ $appartment->floor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="width: 40%;">
            <h3>Spécificités</h3>

            <table style="border: 1px solid black; border-radius: 5px;">
                <tbody>
                    @foreach ($options as $option)
                        <tr>
                            @if ($loop->last)
                                <td style="background-color: white">
                                    {{ $option->name }}
                                </td>
                            @else
                                <td style="border-bottom: 1px solid black; background-color: white">
                                    {{ $option->name }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");            
            
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[slideIndex-1].style.display = "block";
        }
    </script>
@endsection