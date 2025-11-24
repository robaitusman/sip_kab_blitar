@inject('comp_model', 'App\Models\ComponentsData')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>


</head>

<body>
    <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="screen-1">
        <div class="logo">
            <img src="{{ asset('img/logosipblitar.png') }}" alt="logo">
            <h2>Register</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
        @endif
        <form id="users-userregister-form" role="form" novalidate enctype="multipart/form-data"
            class="form page-form form-horizontal needs-validation" action="{{ route('auth.register_store') }}"
            method="post" method="post">
            @csrf
            <div class="email">
                <label for="email">Username</label>
                <div class="sec-2">
                    <ion-icon name="person-outline"></ion-icon>
                    <input id="ctrl-username" data-field="username" value="<?php echo get_value('username'); ?>" type="text"
                        placeholder="Username" required="" name="username"
                        data-url="componentsdata/users_username_value_exist/"
                        data-loading-msg="Checking availability ..." data-available-msg="Available"
                        data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                    <div class="check-status"></div>
                </div>
            </div>
            <div class="password">
                <label for="password">Password</label>
                <div class="sec-2">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input id="ctrl-password" data-field="password" value="<?php echo get_value('password'); ?>" type="password"
                        placeholder="Masukan Password" name="password" class="pas password-strength" />
                    <button type="button" class="btn-toggle-password"> <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                <div class="pesan">
                    <small class="fw-bold">Should contain</small>
                    <small class="length chip">6 Characters minimum</small>
                    <small class="caps chip">Capital Letter</small>
                    <small class="number chip">Number</small>
                    <small class="special chip">Symbol</small>
                </div>
            </div>
            <div class="password">
                <label for="password">Konfirmasi Password</label>
                <div class="sec-2">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input id="ctrl-confirm_password-holder" data-match="#ctrl-password"
                        class="form-control password-confirm " type="password" name="confirm_password" required
                        placeholder="Confirm Password" />
                    <button type="button" class="btn-toggle-password"> <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
            </div>
            <div class="password">
                <label for="password">Email</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input id="ctrl-email" data-field="email" value="<?php echo get_value('email'); ?>" type="email"
                        placeholder="Email" required="" name="email"
                        data-url="componentsdata/users_email_value_exist/"
                        data-loading-msg="Checking availability ..." data-available-msg="Available"
                        data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                    <div class="check-status"></div>
                </div>
            </div>
            <div class="password">
                <label for="password">Foto</label>
                <div class="sec-2">
                    <ion-icon name="image-outline"></ion-icon>
                    <div id="ctrl-photo-holder" class=" ">
                        <div class="dropzone " input="-photo" fieldname="photo"
                            uploadurl="{{ url('fileuploader/upload/photo') }}" data-multiple="false"
                            dropmsg="Choose files or drop files here" btntext="Browse"
                            extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                            <input name="photo" id="ctrl-photo" data-field="photo"
                                class="dropzone-input form-control" value="<?php echo get_value('photo'); ?>" type="text" />
                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="password">
                <label for="password">Kecamatan</label>
                <div class="sec-2">
                    <ion-icon name="business-outline"></ion-icon>
                    <select required="" id="ctrl-id_kecamatan" data-field="id_kecamatan" name="id_kecamatan"
                        placeholder="Select a value ..." class="form-select">
                        <option value="">-Pilih Kecamatan-</option>
                        <?php 
                            $options = $comp_model->id_kecamatan_option_list() ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label ?? $value;
                            $selected = Html::get_field_selected('id_kecamatan', $value, "");
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                            <?php echo $label; ?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <button class="login" type="submit">Register </button>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
