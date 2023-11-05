<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<style>
*,
*:before,
*:after{
    padding: 0;
    margin: 0;
}
.nav-item:after{
    content: "";
    position:absolute;
    background-color: #ae9fd0;
    height: 3px;
    width: 0;
    left: 0;
}
.nav-item:hover:after{
    width: 100%;
    transition: 0.3s;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f0eef8;
}
.main-navbar{
    border-bottom: 1px solid #ccc;
}
#footer{
    background-color: #745c98;
    padding-top: 5px;
    padding-bottom: 5px;
    color: #fff;
    padding-left: 3%;
}

.main-navbar .top-navbar {
    background-color: #745c98;
    padding-top: 10px;
    padding-bottom: 10px;
}
.main-navbar .top-navbar .brand-name{
    color: #fff;
}
.brand-name{
    padding-left: 6%;
    text-transform: uppercase;
}
.main-navbar .top-navbar .nav-link{
    color: #fff;
    font-size: 16px;
    font-weight: 500;
}
.main-navbar .top-navbar .dropdown-menu{
    padding: 0px 0px;
    border-radius: 0px;
}
.main-navbar .top-navbar .dropdown-menu .dropdown-item{
    padding: 8px 16px;
    border-bottom: 1px solid #ccc;
    font-size: 14px;
}
.main-navbar .top-navbar .dropdown-menu .dropdown-item i{
    width: 20px;
    text-align: center;
    color: #d6cfe2;
    font-size: 14px;
}
.dropdown-item:hover{
    width: 100%;
    transition: 0.6s;
    background-color: #ae9fd0;
    color: #fff;
}
.dropdown-item i:hover{
    color: #fff;
}
@media only screen and (max-width: 600px) {
    .main-navbar .top-navbar .nav-link{
        font-size: 12px;
        padding: 8px 10px;
    }
}
.logo{
    text-decoration: none;
    color: #000;
}
.btn-div{
    padding-top: 20px;
}
.btn{
    background-color: #ae9fd0;
    color: #fff;
}
.card-body{
    background-color: #d6cfe2;
    color: #745c98;
}
.card-header, .card-footer{
    background-color: #745c98;
    padding-top: 5px;
    padding-bottom: 5px;
    color: #fff;
}
.container{
    padding-top: 20px;
    margin-bottom: 75px;
}
.col-md-2{
    padding-left: 15px;
    position: relative;
}
.character{
    width: 48px;
    height: 30px;
    background: #745c98;
    overflow: hidden;
}
.character_ditto_sprite{
    width: 192px;
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
    top: -10px;
}
.characterroll{
    margin-left: 65px;
    width: 54px;
    height: 30px;
    background: #745c98;
    overflow: hidden;
}
.character_roll_sprite{
    width: 216px;
    animation: moveSpritesheet2 1s steps(4) infinite;
    position: relative;
    overflow: hidden;
}
.left{
    left: -10px;
    top: -15px;
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
    <div class="main-navbar shadow-sm sticky-top">
        <div class="top-navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <a  class="logo" href="{{url('shapi')}}"><h5 class="brand-name">Shapi</h5></a>
                    </div>
                    <div class="col-md-5 my-auto">
                        <form action = "/search" method = "POST" role="search">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input type="search" placeholder="Search your product" class="form-control" name = "q"/>
                                    <button class="btn bg-white" type="submit">

                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                    </div>
                    <div class="col-md-5 my-auto">
                        <ul class="nav justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{url('signup')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg> Sign Up
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{url('loginhere')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                </svg> Login
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> Account
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('account/buyer')}}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="{{url('account/buyer')}}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li><a class="dropdown-item" href="{{url('account/buyer')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <section class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Sign up</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('register-user') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value = "{{old('name')}}" class="form-control">
                        @error('name')<p class="text text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value = "{{old('email')}}" class="form-control">
                        @error('email')<p class="text text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')<p class="text text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class = "form-group">
                        <label class="col-form-label">Role</label>
                        <div class="col-md-2">
                            <input type="radio" name="roleid" value="0"> Buyer
                        </div>
                        <div class="col-md-2">  
                                <input type="radio" name="roleid" value="1"> Seller
                        </div>
                        @error('roleid')<p class="text text-danger">{{ $message }}</p> @enderror
                    </div>
                
                    <div class="btn-div">
                        <button type="submit" class="btn" onclick="window.location.href='{{ url('/verification') }}'">Sign up</button>
                    </div>

                </form>
            </div>
            <div class="card-footer">
            <a class="nav-link" href="{{url('loginhere')}}"><i><u>Already have an account?</u></i></a>
            </div>
        </div>
    </section>

        <div class="fixed-bottom" id="footer">
        <div class="row">
            <div class="col-md-10 my-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z"/>
                </svg> 2023 All Rights Reserved | Project by Hannah Buizon Ferrand Noche OdeDjinn Suba
            </div>
            <div class="col-md-1 my-auto">
                <a href="{{url('shapi')}}"><div class="characterroll">
                <img class="character_roll_sprite pixelart left" src="{{URL('uploads/roll.png')}}">
                </div></a>
            </div>
            <div class="col-md-1 my-auto">
                <a href="{{url('shapi')}}"><div class="character">
                <img class="character_ditto_sprite pixelart face-up" src="{{URL('uploads/dittoos.png')}}">
                </div></a>
            </div>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
