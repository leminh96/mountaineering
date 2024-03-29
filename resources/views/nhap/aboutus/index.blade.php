@extends('nhap.layout.user')

@section('content')
<div class="container-fluid blog py-6">
    <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About Us</small>
        <h1 class="display-5 mb-3">Mountaineering Adventures</h1>
        <h6 class="text-center mb-5">Every thing you need to know about mountaineeing</h6>
    </div>
    <div class="container-custom wow bounceInUp" data-wow-delay="0.5s">
        <p style="text-indent: 3.5em;">Mountaineering Adventures invites you to embark on a journey to explore the world's most majestic peaks and indulge in thrilling adventures amidst the wilderness.</p>
        <p style="text-indent: 3.5em;">Nestled in the heart of breathtaking mountain ranges, Mountaineering Adventures stands as the epitome of exploration and discovery. Our mission is to ignite the spirit of adventure within every traveler, fostering a deep connection with nature while facilitating the conquest of towering summits.</p>
        <img src="{{asset('/img/aboutus/1.jpg')}}" alt="Mountaineering Adventures" class="img-fluid mx-auto d-block" style="margin-top: 50px; margin-bottom: 50px">
        <p style="text-indent: 3.5em;">At Mountaineering Adventures, we understand that each adventurer is unique, with varying levels of experience and aspirations. Thus, we offer a diverse array of guided expeditions and personalized trips meticulously crafted to cater to every individual's needs and preferences. Whether you're a seasoned mountaineer seeking a new challenge or a novice yearning to step into the realm of high-altitude adventure, we have the perfect expedition for you.</p>
        <p style="text-indent: 3.5em;">Our team comprises seasoned guides and outdoor enthusiasts who are not only experts in their field but also share an unwavering passion for the mountains. With their wealth of experience and intimate knowledge of the terrain, they ensure that every journey with us is not just safe and memorable but also filled with moments of sheer exhilaration and awe-inspiring beauty.</p>
        <img src="{{asset('/img/aboutus/2.jpg')}}" alt="Mountaineering Adventures" class="img-fluid mx-auto d-block" style="margin-top: 50px; margin-bottom: 50px">
        <p style="text-indent: 3.5em;">Embark on an expedition with Mountaineering Adventures, and prepare to be enchanted by the rugged beauty of snow-capped peaks, the crisp mountain air, and the serenity of untouched wilderness. Whether you're scaling the iconic summits of the Himalayas, exploring the jagged peaks of the Andes, or traversing the icy landscapes of Antarctica, each adventure promises a unique blend of challenges and rewards, leaving you with memories to cherish for a lifetime.</p>
        <img src="{{asset('/img/aboutus/3.jpg')}}" alt="Mountaineering Adventures" class="img-fluid mx-auto d-block" style="margin-top: 50px; margin-bottom: 50px">
        <h6 style="text-align: right; margin: 30px;">Victory Team.</h6>
    </div>
</div>

@endsection

<style>
    .container-custom {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #007bff;
    }

    p {
        margin-top: 30px;
        margin-bottom: 20px;
        line-height: 2;
    }
</style>