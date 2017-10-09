<div class="pruh" id="pruh-menu" style="background-image: url(soubory/hlavni_uvodka.jpg); height: 300px; background-size: auto 400%; background-position: 50% 45%"></div>

<div class="pruh" id="o-festivalu">
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

<div class="pruh" style="background-image: url(soubory/hodinky.jpg); background-size: auto 150%; background-position: bottom;" id="prakticke">
    <div class="obsah">
        <h2>Praktické info</h2>
        <div class="box1">
            <div>
                <p><em>KDY?</em> 3. - 5. listopadu 2017</p>
                <p><em>KDE?</em> Festival proběhne pochopitelně ve středobodu larpové komunity, české i světové, v Brně.
</p>
                <p><em>UBYTOVÁNÍ:</em> Bude zajištěno v hotelu Hilton (spacáky a karimatky s sebou).</p>
                <p><em>ZA KOLIK?</em> Většina her stojí 200 nebo 300 Kč, ubytování 50 Kč a tričko 200 Kč.</p>
                <p><em>PROČ?</em> Na tomto místě bychom vám rádi zpříjemnili den zábavným kvízem. Vyberte si tedy jednu, nebo klidně i více odpovědí:</p>
                <ul>
                    <li>protože chceme uspokojit přání hráčů, kteří si ještě nestihli zahrát některé skvělé hry, jež už leckdy nejsou na běžných festivalech k mání
                    <li>protože máme rádi šampaňské, vybranou společnost a vytříbenou společenskou konverzaci
                    <li>protože nemáme na práci nic lepšího než píchat do vosího hnízda larpové komunity
                    <li>protože tento rok ještě neproběhlo předání Zlatého larpíka
                </ul>
                <p><em>PÁRTY?</em> Bude! (viz níže)</p>
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

<div class="pruh" style="background-image: url(soubory/auto.jpg); height: 800px; background-size: auto 100%; "></div>

<div class="pruh" id="larpy">
    <div class="obsah">
        <?php include 'casti/larpy.php' ?>
    </div>
</div>

<div class="pruh" style="height: 700px; background-image: url(soubory/sklenice.jpg); background-size: auto 100%;"></div>

<div class="pruh" id="party">
    <div class="obsah">
        <h2>Párty</h2>
        <p>Sobotní párty bude vrcholem festivalu, můžete se těšit na tombolu, předávání zlatého larpíka a vybranou společnost.<br>
        <em>Dress code</em>: Black Tie (smoking/šaty), avšak uvítáme vás v čemkoliv.</p>
        <p>V pátek se možná bude konat tajná párty nejmenované larpové společnosti, která slaví své desetileté jubileum. Tato exkluzivní událost bude pro uzavřenou společnost, do které se samozřejmě všichni hosté Festivalu elitních larpů počítají a jsou srdečně zváni. Možná nebude tak snadné ji najít, po více informacích se ptejte u registračního pultu.</p>
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
