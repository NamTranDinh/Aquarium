<div id="animate-rotate" style="display: none;">
    <div class="overlay" style="background: #0f0f0f54; z-index: 99999999999;"></div>
    <div id="ani-rotate">
        <span class="sk-circle1 sk-child"></span>
        <span class="sk-circle2 sk-child"></span>
        <span class="sk-circle3 sk-child"></span>
        <span class="sk-circle4 sk-child"></span>
        <span class="sk-circle5 sk-child"></span>
        <span class="sk-circle6 sk-child"></span>
        <span class="sk-circle7 sk-child"></span>
        <span class="sk-circle8 sk-child"></span>
        <span class="sk-circle9 sk-child"></span>
        <span class="sk-circle10 sk-child"></span>
        <span class="sk-circle11 sk-child"></span>
        <span class="sk-circle12 sk-child"></span>
    </div>
</div>
<style>
    .rotate-no-fixed{
        position: relative !important;
    }
    #ani-rotate {
        width: 80px;
        height: 80px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #ani-rotate .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
    }

    #ani-rotate .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 12%;
        height: 12%;
        background-color: #222;
        border-radius: 100%;
        -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
    }

    #ani-rotate .sk-circle2 {
        -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        transform: rotate(30deg);
    }

    #ani-rotate .sk-circle3 {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg);
    }

    #ani-rotate .sk-circle4 {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    #ani-rotate .sk-circle5 {
        -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
        transform: rotate(120deg);
    }

    #ani-rotate .sk-circle6 {
        -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
        transform: rotate(150deg);
    }

    #ani-rotate .sk-circle7 {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    #ani-rotate .sk-circle8 {
        -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
        transform: rotate(210deg);
    }

    #ani-rotate .sk-circle9 {
        -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
        transform: rotate(240deg);
    }

    #ani-rotate .sk-circle10 {
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    #ani-rotate .sk-circle11 {
        -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
        transform: rotate(300deg);
    }

    #ani-rotate .sk-circle12 {
        -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
        transform: rotate(330deg);
    }

    #ani-rotate .sk-circle2:before {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    #ani-rotate .sk-circle3:before {
        -webkit-animation-delay: -1s;
        animation-delay: -1s;
    }

    #ani-rotate .sk-circle4:before {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    #ani-rotate .sk-circle5:before {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    #ani-rotate .sk-circle6:before {
        -webkit-animation-delay: -0.7s;
        animation-delay: -0.7s;
    }

    #ani-rotate .sk-circle7:before {
        -webkit-animation-delay: -0.6s;
        animation-delay: -0.6s;
    }

    #ani-rotate .sk-circle8:before {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s;
    }

    #ani-rotate .sk-circle9:before {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s;
    }

    #ani-rotate .sk-circle10:before {
        -webkit-animation-delay: -0.3s;
        animation-delay: -0.3s;
    }

    #ani-rotate .sk-circle11:before {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s;
    }

    #ani-rotate .sk-circle12:before {
        -webkit-animation-delay: -0.1s;
        animation-delay: -0.1s;
    }

    @-webkit-keyframes sk-circleBounceDelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @keyframes sk-circleBounceDelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }
</style>
