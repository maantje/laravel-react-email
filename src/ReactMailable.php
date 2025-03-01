<?php

namespace Maantje\ReactEmail;

use Illuminate\Mail\Mailable;

class ReactMailable extends Mailable
{
    use ReactMailView;
}
