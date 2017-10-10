<div class="pruh obrazek" style="background-image: url(soubory/hlavni_uvodka.jpg); height: 300px;"></div>

<a name="o-festivalu"></a>
<div class="pruh">
    <div class="obsah">
        <p class="highlight">Exkluzivní zážitek. Pouze hry v červených číslech. Larpový galavečer. V.I.P. hosté. Šampaňské a červený koberec. To nejlepší z české larpové scény na Festivalu elitních larpů. V Brně, samozřejmě.</p>

        <p style="text-align: center" id="viceodstavec"><a href="#" class="zlata" onclick="ukaz_o_festivalu(); return false">více o festivalu…</a></p>

        <div style="display:none">
            <p>Festival elitních larpů bojuje se zhoubným vlivem špatných her, které na scénu začaly probublávat především kvůli <a href="http://hrajularpy.cz/festivalotrlehohrace" target="_blank">Festivalu otrlého hráče</a>. My jsme řekli ne všem rychlokvaškám z larpworkshopů a podobných pochybných akcí. Organizátoři našich larpů nemají zapotřebí schovávat se před hráči na záchodcích a kvalita našich larpů vás nikdy nepřinutí rozseknout si hlavu, abyste se dočkali konce hry. Nabízíme stoprocentní garanci zábavy nebo vrácení peněz. </p>

            <p>Festival pořádá brněnské sdružení <a href="http://hrajularpy.cz">Hraju larpy</a>, které se vyznačuje seriózním a odpovědným přístupem a plně uznává svou povinnost kompenzovat hráče loňského Festivalu otrlého hráče za zážitky, jimž byli vystaveni. Zváni jsou samozřejmě i ostatní účastníci.</p>
            <p>Na setkání s vámi se těší a veškerou odpovědnost za stížnosti na nevhodné humory přebírá organizační tým - Cemi, Ciri, Maník, Godric, Yuffie, Marek.</p>
        </div>
    </div>
</div>

<a name="prakticke"></a>
<div class="pruh obrazek" style="background-image: url(soubory/hodinky.jpg);">
    <div class="obsah">
        <h2>Praktické info</h2>
        <div class="box1">
            <div>
                <p><em>KDY?</em> 3. - 5. listopadu 2017</p>
                <p><em>KDE?</em> Festival proběhne pochopitelně ve středobodu larpové komunity, české i světové, v Brně.
</p>
                <p><em>UBYTOVÁNÍ:</em> Bude zajištěno v hotelu Hilton (spacáky a karimatky s sebou).</p>
                <p><em>ZA KOLIK?</em> Většina her stojí 200 nebo 300 Kč, ubytování 50 Kč/noc a tričko 150 Kč.</p>
                <p><em>PROČ?</em> Na tomto místě bychom vám rádi zpříjemnili den zábavným kvízem. Vyberte si tedy jednu, nebo klidně i více odpovědí:</p>
                <ul>
                    <li>protože chceme uspokojit přání hráčů, kteří si ještě nestihli zahrát některé skvělé hry, jež už leckdy nejsou na běžných festivalech k mání
                    <li>protože máme rádi šampaňské, vybranou společnost a vytříbenou konverzaci
                    <li>protože nemáme na práci nic lepšího než píchat do vosího hnízda larpové komunity
                    <li>protože tento rok ještě neproběhlo předání Zlatého larpíka
                </ul>
                <p><em>KONTAKT:</em><a href="mailto: festivalelitnichlarpu@gmail.com">festivalelitnichlarpu@gmail.com</p>
            </div>
        </div>
    </div>
</div>

<div class="pruh" id="prihlaska">
    <div class="obsah">
        <?php include 'casti/prihlaska-text.html' ?>
        <p class="highlight"><a href="prihlaska">K formuláři ZDE</a></p>
    </div>
</div>

<div class="pruh obrazek" style="background-image: url(soubory/auto.jpg); height: 500px;"></div>

<div class="pruh" id="larpy">
    <div class="obsah larpy">
        <?php include 'casti/larpy.php' ?>
    </div>
</div>

<div class="pruh obrazek" style="height: 500px; background-image: url(soubory/sklenice.jpg);"></div>

<div class="pruh" id="party" style="min-height: 405px;">
    <div class="obsah">
        <h2>Párty</h2>
        <p>Sobotní párty bude vrcholem festivalu, můžete se těšit na předávání zlatého larpíka, vybranou společnost a další program.<br>
        <em>Dress code</em>: Black Tie (smoking/šaty), avšak uvítáme vás v čemkoliv.</p>
        <p>V pátek se bude konat tajná párty <a href="http://courtofmoravia.cz" target="_blank">nejmenované larpové společnosti</a>, která slaví své desetileté jubileum. Tato exkluzivní událost bude pro uzavřenou společnost, do které se samozřejmě všichni hosté Festivalu elitních larpů počítají a jsou srdečně zváni. Možná nebude tak snadné ji najít, po více informacích se ptejte u registračního pultu.</p>
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
