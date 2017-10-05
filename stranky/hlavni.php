<div class="pruh" style="background-image: url(soubory/hlavni_uvodka.jpg); height: 300px; background-size: auto 400%; background-position: 50% 45%"></div>

<div class="pruh" id="o-festivalu">
    <div class="obsah">
        <p class="highlight">Exkluzivní zážitek. Pouze hry s hodnocením v červených číslech. Larpový galavečer. V.I.P. hosté. Šampaňské a červený koberec. To nejlepší z české larpové scény na festivalu elitních larpů. V Brně, samozřejmě.</p>

        <p style="text-align: center" id="viceodstavec"><a href="#" class="zlata" onclick="ukaz_o_festivalu(); return false">více o festivalu…</a></p>

        <div style="display:none">
        Festival elitních larpů bojuje se zhoubným vlivem špatných her, které se zejména v poslední době roztahují na české scéně komorních larpů. My jsme řekli ne všem rychlokvaškám z larpworkshopů a podobných pochybných akcí, které zamořují naši komunitu. Přineseme vám pouze ověřené a kvalitní kusy.

        Festival pořádá brněnské sdružení Hraju larpy, které se vyznačuje seriózním a odpovědným přístupem a plně uznává svou povinnost kompenzovat hráče loňského festivalu otrlého hráče za zážitky, jimž byli vystaveni. Zváni jsou samozřejmě i ostatní účastníci.

        Na setkání s vámi se těší a veškerou odpovědnost za stížnosti na nevhodné humory přebírá organizační tým - Cemi, Ciri, Maník, Godric, Yuffie, Marek.
        </div>
    </div>
</div>

<div class="pruh" style="background-image: url(soubory/hodinky.jpg); background-size: auto 150%; background-position: bottom;" id="prakticke">
    <div class="obsah">
        <h2>Praktické info</h2>
        <div class="box1">
            <div>
                <p><em>KDY?</em> 3. - 5. listopadu 2017</p>
                <p><em>KDE?</em> Pochopitelně festival proběhne ve středobodu larpové komunity, české i světové, v Brně.</p>
                <p><em>UBYTOVÁNÍ:</em> Bude zajištěno hotelu Hilton (spacáky a karimatky s sebou). Exkluzivně pro hosty festivalu jen za xx Kč/noc.</p>
                <p><em>ZA KOLIK?</em> (DOPLNIT!)</p>
                <p><em>PROČ?</em> Na tomto místě bychom vám rádi zpříjemnili den zábavným kvízem. Vyberte si tedy jednu, nebo klidně i více odpovědí:</p>
                <ul>
                    <li>protože nemáme na práci nic lepšího než píchat do vosího hnízda larpové komunity
                    <li>protože chceme uspokojit přání hráčů, kteří si ještě nestihli zahrát některé hry ze zlaté larpové éry a tyto již na běžných festivalech nejsou k mání
                    <li>protože máme rádi šampaňské, vybranou společnost a vytříbenou společenskou konverzaci
                    <li>protože máme poměrně vyhraněný názor na některé jevy v larpové komunitě, které ale v žádném případě nebudeme prezentovat
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="pruh">
    <div class="obsah">
        <?php include 'casti/prihlaska-text.html' ?>
        <p class="highlight"><a href="prihlaska">K formuláři ZDE</a></p>
    </div>
</div>

<script>
function ukaz_o_festivalu() {
    viceodstavec.style.display = 'none'
    viceodstavec.nextElementSibling.style.display = 'block'
}

if(document.location.hash == '#o-festivalu') {
    ukaz_o_festivalu()
}
</script>
