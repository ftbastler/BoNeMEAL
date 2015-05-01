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
			<ul>
				<li>Ban-Management has to be installed on your Minecraft server</li>
				<li>Ban-Management needs be connected to a MySQL database</li>
				<li>PHP 5.3.7 or higher must be installed on your web server</li>
				<li>MCrypt PHP Extension has to be installed on your web server</li>
			</ul>

			<br />
			<h3>Terms and Conditions</h3>
			<p><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">BoNeMEAL</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://github.com/ftbastler/BoNeMEAL" property="cc:attributionName" rel="cc:attributionURL">ftbastler and contributors</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</p>
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
