@extends('install.app')

@section('content')
    <div class="container">
		<ul class="wizard">
			<li class="active"><span class="badge">1</span> <span class="hidden-xs">Welcome</span></li>
			<li><span class="badge">2</span> <span class="hidden-xs">Configuration</span></li>
			<li><span class="badge">3</span> <span class="hidden-xs">Installation</span></li>
			<li><span class="badge">4</span> <span class="hidden-xs">Finished</span></li>
		</ul>

		<div class="content">
			<h2>Welcome to the Ban-Management of tomorrow!</h2><hr/>
			<p class="lead">This Installer will guide you through the installation of the <b><u>B</u>a<u>N</u> <u>M</u>anagement w<u>E</u>b <u>A</u>pp<u>L</u>ication</b> (BoNeMEAL).</p>
			
			<noscript>
				<p class="bg-warning"><strong><i class="fa fa-exclamation-triangle"></i> Javascript deactivated!</strong> The installer requires Javascript to run - it will not work without it! Please enable Javascript.</p>
				<br />
			</noscript>
			
			<h3>Requirements</h3>
			<p>First of all be sure to have the Ban-Management plugin installed on your Minecraft server and connected to a MySQL database.</p>
			<p>As we are running Laravel, this web app has a few <a href="http://laravel.com/docs/5.0#server-requirements">server requirements</a>.</p>
			<ul>
				<li>PHP 5.4 or higher must be installed on your web server {!! version_compare(PHP_VERSION, '5.4.0') >= 0 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
				<li>MCrypt PHP Extension has to be installed on your web server {!! extension_loaded('mcrypt') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
				<li>OpenSSL PHP Extension has to be installed on your web server {!! extension_loaded('openssl') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
				<li>Mbstring PHP Extension has to be installed on your web server {!! extension_loaded('mbstring') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
				<li>Tokenizer PHP Extension has to be installed on your web server {!! extension_loaded('tokenizer') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
				<li>JSON PHP Extension has to be installed on your web server {!! extension_loaded('json') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-exclamation-triangle text-danger"></i>' !!}</li>
			</ul>

			<br />
			<h3>Terms and Conditions</h3>
			<p><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">BoNeMEAL</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://github.com/ftbastler/BoNeMEAL" property="cc:attributionName" rel="cc:attributionURL">ftbastler and contributors</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a> (see <a href="https://github.com/ftbastler/BoNeMEAL/blob/master/LICENSE.md">LICENSE</a>).</p>
			<p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</p>
			<p><i>By downloading and/or installing the software you agree with these terms and conditions.</i></p>
		</div>

		<div class="buttons">
			<a href="{{ url('/install/config') }}" class="btn btn-primary disabled" id="start">Agree &amp; Continue <i class="fa fa-chevron-right"></i></a>
		</div>

		<script>
			// Make sure JS is activated by enabling the button with JS
			enableButton();
		</script>
    </div>
@endsection
