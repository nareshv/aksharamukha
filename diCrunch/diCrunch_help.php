<?PHP


$op .= <<<CWS

<div class="wrapper">
<h2>உதவி &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">முகப்பு</a> &raquo;</h2>

<div class="preferenceheading">
<b>குறியீட்டு முறை விளக்கங்கள்</b> 
</div>
<div class="preferencefield">

<ul>
<li>சிறப்புக்குறியீட்டினை தேர்ந்தெடுத்தால், உரைக்கு ஏரியல் யூனிகொடு எம்.எஸ். ஃபான்ட் பயன்படுத்தப்படும். <li>பிற மொழிகளில் இருந்து சாதாரண தமிழெழுத்துக்கு மாற்றம் செய்ய <b><i> இலக்கில்: </i> தமிழ் - இலக்கு </b> என்ற தேர்வை பயன்படுத்தவும்

<li>தமிழெழுத்துக்களை பிற மொழிகளுக்கு எழுத்துமாற்றம் செய்ய <b><i> மூலத்தில்:</i> தமிழ் - எழுத்துப்பெயர்ர்பு</b> என்ற தேர்வை பயன்படுத்தவும்

<li>தமிழெழுத்துக்களை பிற மொழிகளுக்கு ஒலிமாற்றம் செய்ய <b><i> மூலத்தில்:</i> தமிழ் - ஒலிப்பெயர்ர்பு</b> என்ற தேர்வை பயன்படுத்தவும்
</ul>

<br/><b>காண்க: <a href="Character Matrix.pdf">எழுத்து ஒப்பீட்டு அட்டவணை </a> </b>
<b>காண்க: <a href="Instruction Manual.pdf">பயன்படுத்தற் கையேடு</a> </b>
</div>

<div class="preferenceheading">
<b>கோப்பு</b> உள்ளீட்டு விபரங்கள்
</div>
<div class="preferencefield">
<b>பின்வரும் கோப்புகளே</b> அப்லோடு செய்ய அனுமதிக்கப்பட்டுள்ளன: <b>{$exts}</b>. தற்சயம் ASCII குறியீட்டில் உள்ள கோப்புகள் மட்டுமே உள்ளீடாக ஏற்றுக்கொள்ளப்படும்.
</div>

<!-- <div class="preferenceheading">
<b>தேர்வுகள்</b> செமிக்கப்படவில்லை !
</div>
<div class="preferencefield">
தேர்வுகள் குக்கிகள் மூலம் செயல்படுத்தப்படுகின்றன. தங்கள் பிரவுசர் குக்கிகளை அனுமதிக்கின்றதா என்பதை உறுதி செய்து கொள்ளவும்.
</div> -->

<div class="preferenceheading">
<b>பரிந்துரைக்கப்படும் ஃபான்ட்கள்</b> 
</div>
<div class="preferencefield">
இக்கருவியின் இயல்பாக  <b><a href="http://www.code2000.net/" target="_blank">CODE2000</a></b>, என்ற Pan-Unicode ஃபான்ட்டை பயன்படுத்துகிறது. <!-- விருப்பத்தேர்வுகள் மூலம் தங்களுக்கு தேவையான ஃபான்ட்டை மாற்றிக்கொள்ள இயலும். -->
</div>

<div class="preferenceheading">
<b>"வழுக்களை தெரிவிக்க"</b> அல்லது இக்கருவியினை பற்றிய உங்கள் கருத்துகளை தெரிவிக்க...
</div>
<div class="preferencefield">
<b>vinodh.vinodh [at] gmail [dot] com </b>என்ற முகவரிக்கு மின்னஞ்சல் செய்யவும்
</div>

<div class="preferenceheading">
<b>உரிம விபரங்கள்</b>
</div>
<div class="preferencefield">
<b>இக்கருவி</b> GNU General Public Licenseஇன் கீழ் விநியோக்கிக்கப்படுகிறது. முழு உரிமத்தையும் <a href="{$_SERVER['PHP_SELF']}?act=license">இங்கே</a> படிக்கலாம். 
</div>

CWS;
?>