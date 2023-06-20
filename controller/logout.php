<?php
Session::init();
Session::destroy();
header('location:index.php?controller=login&action=show');