<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body{
                background: #96ffc1;
            }
            .character{
                width: 64px;
                height: 52px;
                background: #745c98;
                overflow: hidden;
            }
            .character_ditto_sprite{
                    animation: moveSpritesheet 1s steps(4) infinite;
                    position: relative;
                    overflow: hidden;
            }
            @keyframes moveSpritesheet {
                from{
                    transform: translate3d(0px,0,0)
                }
                to{
                    transform: translate3d(-100%,0,0)
                }
            }
            .pixelart{
                image-rendering: pixelated;
            }
            .face-up{
                top: -170px;
            }
            .characterroll{
                width: 64px;
                height: 50px;
                background: #745c98;
                overflow: hidden;
            }
            .character_roll_sprite{
                width: 300px;
                animation: moveSpritesheet2 1s steps(4) infinite;
                position: relative;
                overflow: hidden;
            }
            .left{
                left: -10px;
                top: -97px;
            }
            @keyframes moveSpritesheet2 {
                from{
                    transform: translate3d(0,0px,0)
                }
                to{
                    transform: translate3d(-100%,0,0)
                }
            }
            
            
        </style>
    </head>
    <body>
        <a href="{{url('shapi')}}">
        <div class="character">
        <img class="character_ditto_sprite pixelart face-up" src="{{URL('uploads/dittoos.png')}}">
        </div>
        </a>
        <div class="characterroll">
        <img class="character_roll_sprite pixelart left" src="{{URL('uploads/roll.png')}}">
        </div>
    </body>
</html>
