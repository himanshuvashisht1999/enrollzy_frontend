<?php

namespace App\Support;

/** The backend API could not be reached or failed: pages show a "please try again" message. */
class ApiUnavailable extends \RuntimeException
{
}
