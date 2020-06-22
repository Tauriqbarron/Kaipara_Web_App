@extends('layout')

@section('title','Home')

@section('title2','News')

@section('news', 'active')

@section('mainContent')
<div class="container">
    <div class="row">
        <div class="col-4">
            <small>via securitybrief.co.nz</small>
            <a href="https://securitybrief.co.nz/story/interview-advantage-defines-the-most-common-attacks-against-kiwi-firms">
                <div class="p-0 m-0" style="position: relative;">
                    <img alt="Story image" class="m-0 p-0" src="https://securitybrief.co.nz/uploads/story/2020/06/18/GettyImages-652327846.jpg" style="object-fit: scale-down; width: 100%;">
                    <div class="date_capsule">
                        Today
                    </div>
                    <div>

                    </div>
                    <div class="pt-3 pl-4 pb-4">
                        <h1 class="text-dark">Interview: Advantage defines the most common attacks against Kiwi firms</h1>
                        <div class="text-dark mt-2">
                            “In almost all cases Advantage has been involved with this year, there has been a growing trend that the event that brings attention to the breach occurs quite some time after the initial breach."<span class="more_button">More</span>
                        </div>
                    </div>
                    <div style="position: absolute; left: 0px; bottom: 0px; z-index: 4; width: 5px; height: 80px; background-image: linear-gradient(0deg, #6200a3, white);">
                    </div>
                    <div style="position: absolute; left: 0px; bottom: 0px; z-index: 4; width: 80px; height: 5px; background-image: linear-gradient(90deg, #6200a3, white);">
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 bg-light rounded">
            <small>via security.org.nz</small>
            <a href="https://security.org.nz/government-announces-apprenticeship-support-programme-and-targeted-training-and-apprenticeship-fund/">
                <div class="p-0 m-0" style="position: relative;">
                    <img alt="Story image" class="m-0 p-0" src="{{url('images/nzsa-colour-logo-3rd.png')}}" style="object-fit: scale-down; width: 100%;">
                    <div class="date_capsule">
                        Today
                    </div>
                    <div>

                    </div>
                    <div class="pt-3 pl-4 pb-4">
                        <h1 class="text-dark ">Government announces apprenticeship support programme and targeted...</h1>
                        <div class="text-dark mt-2">
                            "The government has announced an Apprenticeship Support Programme targeted at initiatives that will help employers to retain and bring on new apprentices"
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-4">
            <small>via security.org.nz</small>
            <a href="https://security.org.nz/nzsa-launches-good-practice-guidelines-for-security-services-in-new-zealand/">
                <div class="p-0 m-0" style="position: relative;">
                    <img alt="Story image" class="m-0 p-0" src="{{url('images/nzsa-colour-logo-3rd.png')}}" style="object-fit: scale-down; width: 100%;">
                    <div class="date_capsule">
                        Today
                    </div>
                    <div>

                    </div>
                    <div class="pt-3 pl-4 pb-4">
                        <h1 class="text-dark">NZSA launches Good Practice Guidelines for Security Services in New Zealand</h1>
                        <div class="text-dark mt-2">
                            “On the 18th November 2011 Security Officer Charanpreet Singh Dhaliwal commenced employment with CNE Security and was assigned to work at a construction site in Henderson."<span class="more_button">More</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
