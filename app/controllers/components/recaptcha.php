<?php
/*****************************************************************************
The MIT License

Copyright (c) 2007 R. Wong (Lick)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*****************************************************************************/

// Get "recaptchalib.php" from http://code.google.com/p/recaptcha/downloads/list?q=label:phplib-Latest 
// and place it in "vendors/recaptcha".
vendor('recaptcha/recaptchalib');


class RecaptchaComponent extends Object
{
    var $controller = true;
    var $disableStartup = true;
    
    // Sign up at http://www.recaptcha.net and you will receive a publickey 
    // and a privatekey for your domain. Copy and paste them below.
    var $publickey = '6LdX2QAAAAAAAOHP9iSJKOLbdeVzLmaF5SkGhnKL';
    var $privatekey = '6LdX2QAAAAAAAF9qI95frvGv5Wq5NBJ2SceieD05';
    

    function display()
    {
        return recaptcha_get_html($this->publickey);
    }
    

    function is_valid($form)
    {
        if (isset($form['recaptcha_challenge_field']) &&
            isset($form['recaptcha_response_field']) )
        {
            $resp = recaptcha_check_answer(
                $this->privatekey, 
                $_SERVER["REMOTE_ADDR"],
                $form['recaptcha_challenge_field'], 
                $form['recaptcha_response_field']
            );

            if ($resp->is_valid)
                return true;
        }
        
        return false;
    }
}


/*****************************************************************************
Example:

class ExampleController extends AppController
{
    var $uses = array();
    var $components = array('Recaptcha');
    var $autoLayout = false;
    
    function index()
    {
        $message = 'Invalid reCAPTCHA.';
        
        if (isset($this->params['form']) && $this->Recaptcha->is_valid($this->params['form']) )
        {
            $message = 'Valid reCAPTCHA!';
        }
        
        $this->set('message', $message);
        $this->set('recaptcha', $this->Recaptcha->display());
    }
}
*****************************************************************************/

?>