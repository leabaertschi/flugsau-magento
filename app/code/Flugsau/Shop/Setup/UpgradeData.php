<?php
namespace Flugsau\Shop\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected $_blockFactory;

    /**
     * Construct
     *
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Magento\Cms\Model\BlockFactory $blockFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_blockFactory = $blockFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {

            $layoutXml = <<<XML
<referenceContainer name="page.top">
    <block class="Magento\Framework\View\Element\Template" name="home_cover" template="Flugsau_Shop::html/home_cover.phtml" before="-" />
    <block class="Flugsau\Shop\Block\Categories" name="category_tiles" template="Flugsau_Shop::html/category_tiles.phtml" />
    <block class="Magento\Framework\View\Element\Template" name="home_teaser" template="Flugsau_Shop::html/home_teaser.phtml" />
    <block class="Smartwave\Porto\Block\Template" name="home_instagram" template="Flugsau_Shop::html/instagramphotos.phtml">
        <arguments>
            <argument name="padding_item" xsi:type="string">15px</argument>
        </arguments>
    </block>
    <block class="Magefan\Blog\Block\Widget\Recent">
        <arguments>
            <argument name="title" xsi:type="string">News</argument>
            <argument name="number_of_posts" xsi:type="number">2</argument>
            <argument name="category_id" xsi:type="number">0</argument>
            <argument name="custom_template" xsi:type="string">Flugsau_Shop::html/home_news.phtml</argument>
        </arguments>
    </block>
</referenceContainer>
XML;

            $page = $this->_pageFactory->create();
            $page->setTitle('Flugsau Home')
                ->setIdentifier('flugsau-home-page')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setLayoutUpdateXml($layoutXml)
                ->save();
        }


        if (version_compare($context->getVersion(), '1.0.2') < 0) {
            $about_us_de = <<<HTML
<h2>Firmengeschichte</h2>
<p>Die Flugsau GmbH wurde im Sommer 2010 von Urs Estermann und André Bernhard gegründet. 2013 ist Simon Bärtschi als Gesellschafter mit eingestiegen. "Flugsau" bezeichnet nicht nur die ausgeprägte Beziehung zum Flugsport, der Name beinhaltet bei näherem Hinsehen auch die Initialen der Initiatoren Simon, André und Urs.</p>
<p>Schon lange vor der Firmengründung hatten sich die Flugsäue als begeisterte Piloten intensiv mit der Materie befasst und immer wieder Innovationen in den Flugsport mit eingebracht. Bereits 2009 stellten sie unter dem Label "Acro Zone" auf eigenen Nähmaschinen spezielle Produkte für angefressene Gleitschirm- und Deltapiloten her. Das erste selber entwickelte Gleitschirm Acro Gurtzeug "Acro Zone G1" wurde bei AVA Sport in Montana, Bulgarien produziert.</p>
<p>Nachdem durch ein Unwetter im Sommer 2011 das alte Lager komplett zerstört wurde, mussten die Flugsäue ein neues Zuhause suchen. Nach mehreren Umbauarbeiten konnten sie in Grafenort den lang ersehnten Maschinenpark endlich in Betrieb nehmen...von der Riegelnahtmaschine über den Nähfeldautomat bis hin zu mehreren Industrienähmaschinen und einem Laser für präzise Zuschnitte mit hohem Durchsatz ist alles vorhanden um in Kombination mit Know-How und Innovation neue, qualitativ noch hochwertigere Produkte entstehen zu lassen.</p>
<p>Im Dezember 2012 komplettierten die Flugsäue ihr Angebot mit dem Generalvertrieb von X-Dream Fly Produkten. Zusammen mit dem X-Dream Fly Team, welches sich auf die Konzeption und Herstellung von Notschirmen (Kreuzkappe, Rogallo) konzentriert, entwickeln und produzieren die Flugsäue neue Systeme, Rettungscontainer usw.</p>
<p>Im Frühling 2013 ergab sich mit Chrigel Maurer eine weitere interessante Zusammenarbeit. Auf der Suche nach dem besten Equipment für seine dritte Teilnahme am Redbull X-Alps fand Chrigel bei der Flugsau die ideale Umgebung und das entsprechende Know-How um neue, bahnbrechende Produkte entstehen zu lassen. Zusammen entwickelten Flugsau und Chrigel Maurer unter anderem das leichteste verkleidete Liegegurtzeug mit integriertem Notschirmcontainer und Gütesiegel.</p>
<p>2015 verlässt Urs Estermann die Flugsau GmbH als Gesellschafter. Er widmet sich nun vollständig dem Tandemfliegen (<a href="http://www.freeminds.ch" target="_blank">www.freeminds.ch</a>).</p>
<p>2016 Aufbau des neuen Webshops Flugsau Parts.&nbsp;Bei Flugsau Parts findest du verschiedenste Materialien, um deine Ideen um zu setzen. Vom Reissverschluss, über Stoffe, Ringe, Neopren, Schnallen von Austri Alpin, Schraubglieder von Peguet, Gurten in den Breiten von 10-100mm, aber auch nicht so einfach auf zu treibende Materialien, die nicht im normalen Nählädeli erhältlich sind, bieten wir alles online an. Mehr Informationen unter www.flugsau-parts.ch</p>
<p>Neben der Herstellung unserer Eigenprodukte und dem Import/Verkauf bieten wir in unseren Räumlichkeiten auch den kompletten Service für alle unsere Produkte an. Wir sind spezialisiert auf Gurtzeuge, Rucksäcke, Kundenspezifische Modifikationen und Spezialanfertigungen.</p>
<p><img src="{{media url="wysiwyg/crew.jpg"}}" alt="Flugsau Crew" height="374" width="640"></p>
<p>v.l.n.r.: Thomas Koch (Support), Lea Hänsenberger (Webmaster), Simon Bärtschi (Inhaber, Produktion, Entwicklung), Chrigel Maurer (Entwicklung), André Bernhard (Inhaber, Produktion, Entwicklung)</p>
<p>Unsere Leistungen:</p>
<p>- Entwicklung und Produktion <br>- Import &amp; Verkauf<br> - Reparaturen<br> - Spezialanfertigungen und Modifikationen<br> - Notschirmwartungen und Reparaturen</p>
<p>Showroom und Testcenter:</p>
<p>Eine Gehminute vom Landeplatz und dem Bahnhof Grafenort entfernt inmitten der wunderschönen Bergwelt vom Engelbergertal, Zentralschweiz.</p>
<p>Öffnungszeiten Showroom &amp; Werkstatt:</p>
<p>Dienstag, Mittwoch, Freitag &amp; Samstag: </p>
<p>10:00 - 12:00 / 13:00 - 17:00<br>oder nach telefonischer Voranmeldung.</p>
<p><a target="_blank" href="https://www.google.com/maps/place/Flugsau+GmbH/@46.869984,8.37538,17z/data=!3m1!4b1!4m2!3m1!1s0x478ff6016c246e9f:0x717bb29612653748">-&gt; Anfahrt</a></p>
<p></p>
<p>Postadresse und Kontakt:</p>
<p>Flugsau GmbH<br>Älplerhaus 3<br>6388 Grafenort</p>
<p>Tel 0041 (0)41 637 09 39<br>Mail <a>info[at]flugsau[dot]ch<br><br></a></p>
<p>Videos</p>
<p><br>Flugsau Imagefilm von Yves Hohl<br><iframe width="420" height="236" src="https://player.vimeo.com/video/166916811?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe></p>
<p>Videobericht von Air Report (FR) über Flugsau 2012:<br><iframe width="420" height="236" src="http://player.vimeo.com/video/51104159?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe></p>
<p></p>
<p>Flugsau Team Pilots Trailer 2011:<br><iframe width="420" height="315" src="http://www.youtube.com/embed/Jgj9OkO-bk4?rel=0" allowfullscreen="" frameborder="0"></iframe></p>
<p></p>
<p><br>Bankverbindung</p>
<p>Raiffeisen Region Stans <br> BC-Nr.: 81223<br><br> SWIFT: RAIFCH22 <br> IBAN: CH72 8122 3000 0072 2095 1</p>
HTML;

            $page1 = $this->_pageFactory->create();
            $page1->setTitle('Über Flugsau')
                    ->setContentHeading('Über Flugsau')
                    ->setIdentifier('about-us')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($about_us_de)
                    ->save();


            $about_us_en = <<<HTML
<h2>Company history</h2>
<p>The Flugsau GmbH was founded by Urs Estermann and André Bernhard in summer 2010. In 2013 Simon Bärtschi joined as associate. „Flugsau“ does not only stand for the passionate relationship to aviation, at a closer look the name is also composed of the initials of the founders Simon, André and Urs.</p>
<p>Already long before the foundation of the company the „Flugsäue“, being enthusiastic pilots themselves, intensively got involved into the subject and continuously brought innovations to the paragliding community. With the label “Acro Zone” they already produced special products for excited paragliding pilots on their own sewing-machines in 2009. The first Acro Harness they developed, the “Acro Zone G1”, was produced at Ava Sport in Montana, Bulgary.</p>
<p>Shortly afterwards, and after the old storage was destroyed in a storm in summer 2011, Flugsau had to look for a new home. After some reconstruction work they could finally put the new machine park into operation in Grafenort... From bartacker to electronic patter sewing-machines to industrial sewing-machines and a laser for precise cuts with high output everything is there to create, in combination with know-how and innovation, even more high class products.</p>
<p>In December 2012 Flugsau completed their range of products by starting the distribution of X-Dream Fly products. Together with the X-Dream Fly team who concentrates itself on the development and production of rescues Flugsau develops and produces new systems, rescue containers, etc.</p>
<p>A new collaboration started in spring 2013 with Chrigel Maurer. When looking fort he best lightweight gear for his 3rd participation at the Redbull X-Alps Chrigel Maurer found at Flugsau the ideal environment and the know-how to develop new groundbreaking lightweight harnesses. Together Flugsau and Chrigel Maurer developed, amongst other, the most lightweight performance harness with integrated rescue container and EN certification.</p>
<p>Besides creating our own products and importing and selling products from X-Dream Fly and Chrigel Maurer products we also offer complete service for all our products. We are specialised in harnesses, backpacks, custom modification and custom products.</p>
<p><span><img src="{{media url="wysiwyg/crew.jpg"}}" alt="Flugsau Crew" height="374" width="640"></span></p>
<p><span>l.t.r.: Thomas Koch (support), Lea Hänsenberger (graphics), Simon Bärtschi (owner, production, development), Julia Binkert (g<span>raphics</span>), Loni Müller (production), Urs Estermann, Chrigel Maurer (development), André Bernhard (owner, development, production)</span></p>
<p></p>
<p><span>Our services:</span></p>
<ul>
<li><span>Development &amp; Production</span></li>
<li>Import &amp; Sales</li>
<li>Repairs</li>
<li>Custom modifications and products</li>
<li>Rescue packing &amp; repairs<span></span></li>
</ul>
<p></p>
<p><span>Showroom and Testcenter:</span></p>
<p><span>One minute walking from the landing place und the trainstation Grafenort in the middle of the amazing mountains of the Engelberg valley, Central Switzerland</span></p>
<p></p>
<p><span>Opening times Showroom &amp; Testcenter:</span></p>
<p><span>Tuesday, Wednesday, Friday &amp; Saturday: </span></p>
<p><span>10:00 - 12:00 / 13:00 - 17:00<br>or after phone registration.<br></span></p>
<p><span><a target="_blank" href="https://www.google.com/maps/place/Flugsau+GmbH/@46.869984,8.37538,17z/data=!3m1!4b1!4m2!3m1!1s0x478ff6016c246e9f:0x717bb29612653748"><span>-&gt; Map</span></a></span></p>
<p><span>Directiony by car:<br>Turn left from main road at Restaurant Grafenort, the next intersection right (Before Brunniswald / Eschlenalp Cablecar Station). <br></span></p>
<p></p>
<p><span>Postaladress and contact:</span></p>
<p><span>Flugsau GmbH<br>Älplerhaus 3<br>6388 Grafenort</span></p>
<p><span>Tel 041 637 09 39<br>Mail <a>info[at]flugsau[dot]ch<br><br></a></span></p>
<p><span>Videos</span></p>
<p><span>Videoreport from Air Report (FR) about Flugsau 2012:</span><br><iframe width="420" height="236" src="http://player.vimeo.com/video/51104159?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe></p>
<p><span>&nbsp;</span></p>
<p><span>Flugsau Products Outdoor Trailer 2011:</span><br><iframe width="420" height="315" src="http://www.youtube.com/embed/HRFLJFq2auo?rel=0" allowfullscreen="" frameborder="0"></iframe><br><span></span></p>
<p><br><span></span></p>
<p><br><span>Flugsau Team Pilots Trailer 2011:<br><iframe width="420" height="315" src="http://www.youtube.com/embed/Jgj9OkO-bk4?rel=0" allowfullscreen="" frameborder="0"></iframe><br></span></p>
<p></p>
<p><span><br>Bankwires</span></p>
<p><span>Raiffeisen Region Stans</span> <span><br> BC-Nr.: 81223<br><br> SWIFT: RAIFCH22</span> <span><br> IBAN: CH72 8122 3000 0072 2095 1</span></p>
HTML;

            $page2 = $this->_pageFactory->create();
            $page2->setTitle('About Flugsau')
                    ->setContentHeading('About Flugsau')
                    ->setIdentifier('about-us')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($about_us_en)
                    ->save();

            $about_xdreamfly_de = <<<HTML
<div><img src="{{media url="wysiwyg/x2.jpg"}}" height="169" width="470"></div>
<div></div>
<div></div>
<div></div>
<div>Seit jeher haben wir uns bei der Flugsau mit allen möglichen Notschirm Problematiken auseinandergesetzt um Kunden und Händlern in Kombination mit unseren eigenen Gurtzeug Entwicklungen optimale Gesamtlösungen anbieten zu können. Nachdem Gleitschirmflieger über 20 Jahre lang verschiedene Rundkappen und Rogallo Systeme mit all ihren Vor- und Nachteilen angewendet haben war die Zeit einfach definitiv reif für eine Weiterentwicklung.<br><br>Kreuzkappen werden z.B. beim Militär seit vielen Jahren erfolgreich angewendet, in unsere Szene hat dieses Konzept aber erst vor kurzem durch die Entwickler der X-Dream Fly für Aufsehen gesorgt. Ihre Kreuzkappen bieten nicht etwa, so wie man sie gerne in Hochglanzprospekten der Mitbewerber liest, „noch nie dagewesene Neuerungen“ sondern ganz einfach einen ausgewogenen und praktischen Kompromiss aller wichtigen Eigenschaften. Zum Beispiel wird mit dem Konzept einer Kreuzkappe das bei Rundkappen oft ausgeprägte Pendeln verhindert ohne den Nachteil der Vorwärtsfahrt eines Rogallos.&nbsp;</div>
<p><a href="/xdream-xone-kreuzkappen-notschirm-p-259.html"><span>-&gt; zum X-One Kreuzkappe Notschirm</span></a></p>
<div>
<div><img src="{{media url="wysiwyg/x-one2.png"}}" height="210" width="281"></div>
</div>
<div></div>
<p><br><img src="{{media url="wysiwyg/x-dream.png"}}" height="66" width="112"><br><br></p>
<div><img src="{{media url="wysiwyg/x1.jpg"}}" height="169" width="470"></div>
<p></p>
<div>X-Dream Fly ist ein Label das Dani Loritz vor über 15 Jahren gegründet hat. Schon damals stand der Name für absolute Qualität und höchste Präzision in Sachen Schulung, Sicherheitstraining und betreuten Flugreisen. Dieses schon vorhandene Label passt perfekt zur Ideologie des neuen Teams, welches sich aus Dani Loritz, Gerald Roschmann und Dani Flohr zusammensetzt. Jeder Einzelne bringt langjährige Erfahrung aus verschiedenen Bereichen in das Projekt ein.<br><br>Es ist die Freude am Fliegen und die Bereitschaft das vorhandene Wissen weiterzugeben, welches uns dazu bewegt hat das Projekt X-Dream Fly in einer neuen Form wiederzubeleben.<br><br>Bei uns steht die Qualität und nicht die Quantität im Vordergrund. Nur wer konzentriert und strukturiert arbeitet, wird Erfolg haben.<br><br>
<div>Wir begeistern unsere Piloten, weil&nbsp; im Herzen die Leidenschaft für diesen fantastischen Sport auch nach vielen Jahren unerloschen brennt. Bei uns wirst du etwas erleben und bekommst nicht nur eine Dienstleistung geboten. Wir helfen dir deine Träume zu verwirklichen und deine Ängste zu überwinden.</div>
</div>
<div><br>Das neue Team wird sich engagiert und intensiv für den Erfolg des Projektes einsetzen. Eine ehrliche Aussage dem Kunden gegenüber ist uns sehr wichtig. Das diese auch manchmal unangenehm sein kann, wissen wir. Offenheit und Ehrlichkeit bildet die Grundlage unserer Philosophie dem Kunden gegenüber.<br><br>Uns ist ein verantwortungsvolles Handeln und Entscheiden der Natur gegenüber sehr wichtig, in der wir nicht nur fliegen sondern unser tägliches Leben verbringen dürfen. Du wirst dich bei uns wohl und geborgen fühlen, wie in einer großen Familie.<br><br>Team X-Dream Fly<br>… lebe deinen Traum<br><br>Mehr Informationen auf <a target="_blank" href="http://www.x-dreamfly.ch"><span>www.x-dreamfly.ch</span></a></div>
<p></p>
<div><img src="{{media url="wysiwyg/x3.jpg"}}" height="169" width="470"></div>
HTML;

            $page3 = $this->_pageFactory->create();
            $page3->setTitle('Über X-Dream Fly')
                    ->setContentHeading('Über X-Dream Fly')
                    ->setIdentifier('about-x-dream-fly')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($about_xdreamfly_de)
                    ->save();

            $about_xdreamfly_en = <<<HTML
<div><img src="{media url="wysiwyg/x2.jpg"}}" height="169" width="470"></div>
<div></div>
<div></div>
<div>Since the beginning, we at the Flugsau have always checked all possible reserve parachute problems to offer our customers good systems in combination with our own harness developments. Paragliders have used for over 20 years various round caps and Rogallo systems with all their advantages and disadvantages and now was the time just definitely there for further development.<br><br>Cross caps are successfully applied in the military for many years,but in our scene this concept has caused a stir by the developers of the X-Dream Fly recently. Cross caps do not offer such as one likes to read in glossy brochures of competitors, "unprecedented changes" but simply a balanced and practical compromise of all important properties.</div>
<p><a href="/xdream-xone-kreuzkappen-notschirm-p-259.html"><span>-&gt; to the X-One Cross Cap Rescue</span></a></p>
<div>
<div><img src="{media url="wysiwyg/x-one2.png"}}" height="210" width="281"></div>
</div>
<div></div>
<p><br><img src="{media url="wysiwyg/x-dream.png"}}" height="66" width="112"><br><br></p>
<div><img src="{media url="wysiwyg/x1.jpg"}}" height="169" width="470"></div>
<p></p>
<div><br>More Informations at <a target="_blank" href="http://www.x-dreamfly.ch"><span>www.x-dreamfly.ch</span></a></div>
<p></p>
<div><img src="{media url="wysiwyg/x3.jpg"}}" height="169" width="470"></div>
HTML;

            $page4 = $this->_pageFactory->create();
            $page4->setTitle('About X-Dream Fly')
                    ->setContentHeading('About X-Dream Fly')
                    ->setIdentifier('about-x-dream-fly')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($about_xdreamfly_en)
                    ->save();

            $swiss_dealers_de = <<<HTML
<p>Folgende Flugschulen und Händler führen unsere Produkte und bieten Ihnen kompetente Beratung und Service an:<br><br><a title="Südostschweiz (GR)" name="suedostschweiz"></a><span>Südostschweiz (GR)</span><br><br></p>
<ul>
<li><span>Flugschule Air-Active</span><br>Daniel Flohr<br>via Streia 6<br>CH-7152 Sagogn<br><br>Tel 079 252 4095<br><br><a href="mailto:info@air-active.ch">info[at]air-active[dot]ch</a><br><a href="http://www.air-active.ch" target="_blank">www.air-active.ch</a><br><br></li>
<li><span>Flugschule Swissraft </span><br>Walo Besch<br>Postfach 88 - Via Parlatsch 8<br>CH-7016 Trin Mulin<br><br>Tel 081 911 52 52<br>Fax 081 911 52 51<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgt.txjttsbgu/di');"><span>info[at]fs-swissraft[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.fs-swissraft.ch"><span>www.fs-swissraft.ch</span></a></span><br><br></li>
</ul>
<p><br><br><span><a title="Ostschweiz (SG, AR, AI, TG, SH)" name="ostschweiz"></a>Ostschweiz (SG, AR, AI, TG, SH)</span><br><br></p>
<ul>
<li><span>Flugschule Appenzell</span><br>Adi Hunziker<br>Bahnhof<br>CH-9057 Wasserauen<br><br>Tel 071 799 17 67 <br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAhmfjutdijsn/di');"><span>info[at]gleitschirm[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.gleitschirm.ch/"><span>www.gleitschirm.ch</span></a></span></li>
</ul>
<p><span><br> </span></p>
<ul>
<li><span>Flugschule Alpstein</span><br>Steff Thür<br>Egg 369<br>9055 Bühler AR<br><br>Mobile 079 460 96 29<br>Tel 071 793 12 13<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtdivmf.bmqtufjo/di');"><span>info[at]flugschule-alpstein[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.flugschule-alpstein.ch/"><span>www.flugschule-alpstein.ch</span></a></span></li>
</ul>
<p></p>
<ul>
<li><span>Flugschule Ostschweiz</span><br>Lilienstrasse 3<br>9533 Kirchberg<br><br>Tel 071 931 33 23<br>Mobile 079 691 51 20<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgtp/di');"><span>info[at]fso[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.fso.ch"><span>www.fso.ch</span></a></span></li>
</ul>
<p><br><span><br></span></p>
<ul>
<li><span>Alpina Gleitschirmschule</span><br>Robert Muggli<br>Alte Dorfgasse 3<br>CH-8880 Walenstadt<br><br>Mobile 079 694 54 01<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAht.bmqjob/di');"><span>info[at]gs-alpina[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.gs-alpina.ch"><span>www.gs-alpina.ch</span></a></span></li>
</ul>
<p></p>
<ul>
<li><span>Fly Products</span><br>Jan Lübbig<br>Stögg<br>CH-8897 Flumserberg<br><br>Mobile 079 427 99 77<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;kboAmvfccjh/di');"><span>jan[at]luebbig[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.flyproducts.ch"><span>www.flyproducts.ch</span></a></span></li>
</ul>
<p><br><br><br><br><span>Zürich (ZH)</span><br><br><br></p>
<ul>
<li><span>paraworld.ch / Flugschule Zürich</span><br>Ueli Neuenschwander<br>Weststrasse 41<br>CH-8003 Zürich<br><br>Tel 044 450 26 82<br>Mobile 079 441 92 89<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAqbsbxpsme/di');"><span>info[at]paraworld[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.paraworld.ch"><span>www.paraworld.ch</span></a></span></li>
</ul>
<p><br><br></p>
<ul>
<li><span>Eagle Wings Paragliding</span><br>Adrian Wegmann<br>Grundstrasse 20<br>CH-8320 Fehraltdorf<br><br>Tel 044 955 01 11<br>Mobile 079 259 31 42<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;besjbo/xfhnbooAfbhmf.xjoht/di');"><span>adrian[dot]wegmann[at]eagle-wings[dot]ch</span></a></span><br><span><span><a href="http://www.eagle-wings.ch">www.eagle-wings.ch<br><br><br><br></a><a target="_blank" href="http://www.eagle-wings.ch"></a></span></span></li>
<li>
<p>Gleitschirm-Flugschule Magiclift GmbH<br>Bergstrasse 68<br>CH-8810 Horgen</p>
<p>Mobile 076 393 08 47<br><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAnbhjdmjgu/di');"><br>info[at]magiclift[dot]ch<br></a><a href="mailto:info@magiclift.ch"></a><a href="http://www.magiclift.ch/">www.magiclift.ch</a>&nbsp;</p>
</li>
</ul>
<p><br><br><br><br><span>Jura, Mittelland &amp; Nordschweiz (JU, AG, SO, BS, BL)</span><br><br></p>
<ul>
<li><span>Flugschule Solothurn</span><br>Stefan Keller<br>Langendorfstrasse 2<br>4513 Langendorf<br><br>Mobile 079 337 89 93<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvtp/di');"><span>info[at]fluso[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.fluso.ch/"><span>www.fluso.ch</span></a></span></li>
</ul>
<p><span></span><span><br></span></p>
<ul>
<li><span>Flugschule Feiair</span><br>Peter Feier<br>Rötistrasse 2<br>4532 Feldbrunnen<br><br>Tel 032 677 07 16<br>Mobile 079 325 63 72<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;gfjbjsAcmvfxjo/di');"><span>feiair[at]bluewin[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.feiair.ch/"><span>www.feiair.ch</span></a></span></li>
</ul>
<p><br><br><br><br><span>Zentralschweiz (LU, OW, NW, SZ, UR, ZG, GL)</span><br><br></p>
<ul>
<li><span>Flugsau Testcenter</span><br>Älplerhaus<br>6388 Grafenort<br><br>Tel 041 637 09 39<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');"><span>i<span>nfo[at]flugsau[dot]ch</span></span></a></span><br><a target="_blank" href="/"><span>www.flugsau.ch</span><br><br><br></a></li>
<li><span>Flugrausch - Gleitschirmschule<br><span></span></span>Monika Holler<br>Hauptstrasse 13<br>6386 Wolfenschiessen<br><br>Mobile 079 136 34 30<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;npojAgmzjoh.gsjfoet/mv');"><span>gruezi[at]flugrausch[dot]ch</span></a></span><br><a target="_blank" href="http://flugrausch.ch/"><span><span>www.flugrausch.ch</span></span></a></li>
</ul>
<p></p>
<ul>
<li><span>Flugschule Titlis<br><span></span></span>Martin Zimmermann<br>Hauptstrasse 44<br>6386 Wolfenschiessen<br><br>Mobile 079 642 82 60<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;nbsujoAgmvhtdivmf.ujumjt/di');"><span>martin[at]flugschule-titlis[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.flugschule-titlis.ch"><span>www.flugschule-titlis.ch</span></a></span></li>
</ul>
<p><span>&nbsp;</span></p>
<ul>
<li><span>Flugschule Emmetten<br><span></span></span>Ischenstrasse 5<br>6376 Emmetten<br><br>Tel 041 620 12 12<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtdivmf.fnnfuufo/di');"><span>info[at]flugschule-emmetten[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.flugschule-emmetten.ch/"><span>www.flugschule-emmetten.ch</span></a></span></li>
</ul>
<p></p>
<ul>
<li><span>Airsportcenter Mollis<br><span></span></span>Walter Elmer<br>Netstalerstrasse 60<br>8753 Mollis<br><br>Tel 055 612 36 26<br>Fax 055 612 36 01<br>Mobile 079 421 05 28<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;x/fmnfsAtnjmf/di');"><span>w[dot]elmer[at]smile[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.airsportcenter.ch"><span>www.airsportcenter.ch</span></a></span></li>
</ul>
<p><span></span><br><br><br><br><span>Bern (BE)</span><br><br></p>
<ul>
<li><span>PILOT école de parapente</span><br>Toni Schneeberger<br>Case Postale 112<br>Poste 2<br>2740 Moutier<br><br>Tel 079 472 28 54<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAqjmpu.qbsb/di');"><span>info[at]pilot-para[dot]ch<br></span></a><a target="_blank" href="http://www.pilot-para.ch"><span>www.pilot-para.ch</span></a></span><br><br></li>
<li>
<p>Chill Out Paragliding AG<br>Kari Eisenhut &amp; Beni Kälin<br>Alpenstrasse 16<br>CH 3800 Interlaken<br>Switzerland<br><br></p>
<p>Tel: +41 (0)79 33 99 3 88<br>Fax: +41 (0)33 826 71 72</p>
<p><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAdijmmpvuqbsbhmjejoh/dpn');"><span>info[at]chilloutparagliding[dot]com</span></a></span><br><span><a href="http://www.chilloutparagliding.com"><span>www.chilloutparagliding.com</span></a></span><br><br><br></p>
</li>
<li><span>Valley BASE Gear</span><br>Dan Vicary<br>Airtime Internet Cafe<br>Fuhren<br>3822 Lauterbrunnen<br><br>Tel 076 265 50 82<a target="_blank" href="http://www.gleitschirmschulebern.ch/"><br><br></a><span><a target="_blank" href="http://www.valleybasegear.com"><span>www.valleybasegear.com</span></a></span></li>
</ul>
<p></p>
<ul>
<li>Bumpjump Kiteschule und Kitereparaturen<br>Litzistrasse 31<br>3780 Gstaad<br><br>Tel 079 361 48 03<a target="_blank" href="http://www.bumpjump.ch/"><br><br></a><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAcvnqkvnq/di');"><span>info[at]bumpjump[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.bumpjump.ch"><span>www.bumpjump.ch</span></a></span></li>
</ul>
<p><br><br><br><span>Westschweiz (FR, GE, VD, NE)</span><br><br></p>
<ul>
<li><span>Air Passion, Ecole de Parapente</span><br>Claude Gétaz<br>Route de la Sarine 25<br>1669 Albeuve<br><br>Mobile 079 427 62 87<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAbjsqbttjpo/di');"><span>info[at]airpassion[dot]ch</span></a></span><br><a target="_blank" href="http://www.airpassion.ch/"><span></span></a><a href="http://www.airpassion.ch">www.airpassion.ch</a></li>
</ul>
<p><br><br><span>Wallis (VS)</span><br><br></p>
<ul>
<li><span>Flug-Taxi</span><br>Xandi Furrer<br>3984 Fiesch<br><br>Tel 027 971 53 21<br>Fax 027 971 54 21<br><br><span><a target="_blank" href="http://www.flug-taxi.ch"><span>www.flug-taxi.ch</span></a></span><br><br></li>
<li>Centre de Parapente Flyverbier<br><span></span>Rue du Centre Sportif<br>1936 Verbier<br><br>Tel 027 771 68 18<br><br><span><a><span>info[at]flyverbier[dot]ch</span></a></span><br><span><a target="_blank" href="http://www.flyverbier.ch/"><span>www.flyverbier.ch</span></a></span></li>
</ul>
<p><br><br><br><br><span>Tessin (TI)<br><br></span></p>
<ul>
<li><span>Paramania Flying School</span><br> Renato Wüest<br>Via Essagra<br> 6592 S.Antonino<br><br>Tel 091 857 22 25<br>Fax 091 857 25 34<br>Mobile 079 444 14 55<br><br><span><a href="javascript:linkTo_UnCryptMailto('nbjmup;qbsbnbojbAujdjop/dpn');"><span>paramania[at]ticino[dot]com</span></a></span><br><a target="_blank" href="http://www.paramania.ch"><span><span></span></span></a><a>www.paramania.ch</a><a href="http://www.paramania.ch"><br><br></a></li>
<li>Pink Baron SA<br>Franco Kessel<br>Via C.Maderno 1<br>P.O.Box 240<br>CH-6825 Capolago<br><br>Tel 091 648 30 88<br>Mobile 079 444 4414<br><br><a href="mailto:info@pink-baron.ch">info[at]pink-baron[dot]ch</a><br><a href="http://www.pink-baron.ch">www.pink-baron.ch</a></li>
</ul>
HTML;

            $page5 = $this->_pageFactory->create();
            $page5->setTitle('Schweizer Händler & Testcenter')
                    ->setContentHeading('Schweizer Händler & Testcenter')
                    ->setIdentifier('swiss-dealers')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([0])
                    ->setContent($swiss_dealers_de)
                    ->save();

            $international_dealers = <<<HTML
                <p>Switzerland<br><a href="/main_bigware_30.php?bigwareCsid=1b4429b045ffc0fca233b2898fda8259&amp;pages_id=14&amp;language=de">-&gt; Dealers &amp; Testcenter Switzerland</a></p>
<p>Germany <br><a target="_blank" href="http://store.airgproducts.com/product-category/add-ons/">www.airgproducts.com</a><br><a target="_blank" href="http://www.camforpro.com/shopware.php?sViewport=searchFuzzy&amp;sLanguage=1&amp;sSearch=Flugsau">www.camforpro.com</a><br>&nbsp;<br>Austria<br><a target="_blank" href="http://www.shop.motorschirm.cc/">www.shop.motorschirm.cc</a><br><a target="_blank" href="http://www.fca.at">www.fca.at</a></p>
<p>France<br><a target="_blank" href="http://www.studiosport.fr">www.studiosport.fr</a><br><a target="_blank" href="http://www.lacameraembarquee.fr/recherche?orderby=position&amp;orderway=desc&amp;search_query=flugsau&amp;submit_search=Rechercher">www.lacameraembarquee.fr</a><br><a target="_blank" href="http://www.lavachesenvole.com/">www.lavachesenvole.com</a><br><br>Denmark<br><a target="_blank" href="http://www.speedfly.dk">www.speedfly.dk</a><br><br>Norway<br><a target="_blank" href="http://www.flyby-fester.no/">www.flyby-fester.no</a><br>&nbsp;<br>USA<br><a target="_blank" href="http://www.freeboernairsports.com/">www.freeboernairsports.com</a><br><a target="_blank" href="http://www.flytepark.com">www.flytepark.com</a><br><a target="_blank" href="http://www.trikebuggy.com/">www.trikebuggy.com</a><br> <br>Japan<br><a target="_blank" href="http://www.paraglider.co.jp">www.paraglider.co.jp</a><br>&nbsp;<br>Australia<br><a target="_blank" href="http://www.skyoutparagliding.com/">www.skyoutparagliding.com</a><br>&nbsp;<br>New Zealand<br><a target="_blank" href="http://www.facebook.com/craig.taylor.7374480">www.facebook.com/craig.taylor.7374480</a> (website under construction)<br><br>Chile / Peru <br><a target="_blank" href="http://www.facebook.com/carlos.curidavila">www.facebook.com/carlos.curidavila</a> (website under construction)<br>Mail: <a href="mailto:zcalcar@yahoo.es">zcalcar(at)yahoo(dot)esi</a><br><br>Ecuador<br><a target="_blank" href="http://www.paravolarecuador.com">www.paravolarecuador.com</a><br><br>Brasil<br><a target="_blank" href="http://www.esportesaereosbrasil.com">www.esportesaereosbrasil.com</a><br><br><br>You want to be dealer of our products? Please contact <a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');">info[at]flugsau[dot]ch</a></p>
HTML;

            $page6 = $this->_pageFactory->create();
            $page6->setTitle('International Dealers')
                    ->setContentHeading('International Dealers')
                    ->setIdentifier('international-dealers')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([0])
                    ->setContent($international_dealers)
                    ->save();

            $prices_de = <<<HTML
                <p><br>Für allgemeine Service &amp; Reparaturarbeiten verrechnen wir einen Stundenansatz von CHF 95.-<br><br>Für folgende Leistungen verrechnen wir Pauschalen:<br><br>- Notschirm einbauen inkl. K-Prüfung: CHF 40.-<br>- Notschirmwartung Rund - &amp; Kreuzkappen: CHF 80.-<br>- Notschirmwartung Rogallo (Steuerbare): CHF 90.-<br><br>Hinweis für Acro- und Sicherheitstraining Piloten: Wir können keine triefnassen Notschirme annehmen. Bitte vorgängig selber zum trocknen aufhängen. Vielen Dank.<br><br>Sämtliche Preisangaben auf unserer Homepage sind in Schweizer Franken (CHF) inkl.&nbsp; 8% MwSt.) <br><br><span>Bankverbindung</span><br><br>Raiffeisen Region Stans<br>BC-Nr.: 81223<br><br>SWIFT: RAIFCH22<br>IBAN: CH72 8122 3000 0072 2095 1</p>
HTML;

            $page7 = $this->_pageFactory->create();
            $page7->setTitle('Preise & Pauschalen')
                    ->setContentHeading('Preise & Pauscalen')
                    ->setIdentifier('prices')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($prices_de)
                    ->save();

            $prices_en = <<<HTML
            <p><span id="result_box" lang="en"><span>For general</span> <span>service</span> <span>&amp;</span> <span>repairs</span> <span>we charge a</span> <span>hourly rate of</span> <span>CHF 95</span> <span>-</span><br><br><span>We charge</span> <span>flat rates</span> <span>for</span> <span>the following services</span><span>:</span><br><br><span></span><br><span>- Install the</span> <span>reserve parachute</span><span>: CHF 40</span> <span>-</span><br><span>-</span> Packing <span>Emergency parachute</span> <span>round</span> -&amp; cross<span>cap</span><span></span><span></span><span>: CHF 80</span> <span>-</span><br><span>-</span> Packing <span>Emergency parachute</span> <span>Rogallo</span><span></span><span></span><span></span><span>: CHF 90</span> <span>-</span><br><br><span>Note</span> <span>for</span> <span>acro</span> and safety training <span>pilots</span><span></span><span>:</span> <span>We can not accept</span> <span>dripping wet</span> <span>Rescues</span><span>. </span><span>Please</span> <span>dry</span> them by <span>yourself</span> <span>.</span> <span>Thank you</span><span>.</span><br><br><span>All prices</span> <span>on our</span> <span>website</span><span></span> <span>are</span> <span>in Swiss francs (</span><span>CHF) including</span> <span>8%</span> <span>VAT)</span><br><br><span>Bank</span><br><br><span>Raiffeisen</span> <span>Stans</span><br><span>BC no</span><span>.</span> <span>81223</span><br><br><span>SWIFT:</span> <span>RAIFCH22</span><br><span>IBAN:</span> <span>CH72</span> <span>8122</span> <span>3000</span> <span>0072</span> <span>2095</span> <span>1</span></span></p>
HTML;

            $page8 = $this->_pageFactory->create();
            $page8->setTitle('Prices')
                    ->setContentHeading('Prices')
                    ->setIdentifier('prices')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($prices_en)
                    ->save();

            $webcams = <<<HTML
     <div class="this_frame_text">
																	<br>
																			<ul>
	<li><a href="#stanserhorn">Stanserhorn</a></li>
	<li><a href="#oberdorf">Oberdorf</a></li>
	<li><a href="#wirzweli">Wirzweli</a></li>
	<li><a href="#gummenalp">Gummenalp</a></li>
	<li><a href="#haldigrat">Haldigrat</a></li>
	<li><a href="#wolfenschiessen">Wolfenschiessen</a></li>
	<li><a href="#brunni">Brunni</a></li>
	<li><a href="#klewenalp">Klewenalp</a></li>
</ul>

<h3><a name="stanserhorn">Stanserhorn</a></h3>
<p>
	<a href="http://www.stanserhorn.ch/_webcam/pic.html" target="_blank">
		<img src="http://meteo-nw.ch/stanserhorn/staho_flv.jpg?cache=1535204045" width="100%">
	</a>
</p>

<h3><a name="oberdorf">Oberdorf</a></h3>
<p>
	<img src="http://www.boot-segel-luzern.ch/webcam/oberdorf_sued_upload.jpg?cache=1535204045" width="100%">
</p>


<h3><a name="wirzweli">Wirzweli</a></h3>
<p>
	<img alt="camerabergstation" src="http://www.wirzweli.ch/_data/webcam/camerabergstation.jpg?cache=1535204045" width="100%">
</p>

<h3><a name="gummenalp">Gummenalp</a></h3>
<p>
	<img alt="cameragummenalp" src="http://www.gummenalp.ch/livecam/gummenalp.jpg?cache=1535204045" width="100%">
</p>

<h3><a name="haldigrat">Haldigrat</a></h3>
<h4>Blickrichtung Pilatus</h4>
<p>
	<a href="http://bill-online.net/haldigrat_west.jpg" target="_blank">
		<img alt="haldigrat west" src="http://bill-online.net/haldigrat_west.jpg?cache=1535204045" width="100%">
	</a>
</p>
<h4>Blickrichtung Brisen</h4>
<p>
	<a href="http://bill-online.net/haldigrat_ost.jpg" target="_blank">
		<img alt="haldigrat ost" src="http://bill-online.net/haldigrat_ost.jpg?cache=1535204045" width="100%">
	</a>
</p>

<h3><a name="wolfenschiessen">Wolfenschiessen</a></h3>

<h4>Brändlen Süd</h4>
<p>
	<a target="_blank" href="http://cam.tep.ch/Bilder/Start-Sued-Zoom.jpg?cache=1535204045">
	<img src="http://cam.tep.ch/Bilder/Start-Sued-Zoom.jpg?cache=1535204045" alt="BrÃ¤ndlen SÃ¼d" width="100%">
	</a>
</p>
<p>
	<a target="_blank" href="http://cam.tep.ch/Bilder/Start-Sued.jpg?cache=1535204045">
	<img src="http://cam.tep.ch/Bilder/Start-Sued.jpg?cache=1535204045" alt="BrÃ¤ndlen SÃ¼d" width="100%">
	</a>
</p>

<h4>Brändlen Nord</h4>
<p>
	<a target="_blank" href="http://cam.tep.ch/Bilder/Start-Nord.jpg?cache=1535204045">
	<img src="http://cam.tep.ch/Bilder/Start-Nord.jpg?cache=1535204045" alt="BrÃ¤ndlen Nord" width="100%">
	</a>
</p>

<h4>Bielen</h4>
<p>
	<a href="http://bielenbahn.ch/images/webcam/livebild.jpg?cache=1535204045" target="_blank">
		<img src="http://bielenbahn.ch/images/webcam/livebild.jpg?cache=1535204045" alt="Bielen" width="100%">
	</a>
</p>

<h4>Grafenort</h4>
<p>
	<a href="/webcam/grafenort/webcam.php?breite=1280&amp;cache=1535204045" target="_blank">
		<i><img src="/webcam/grafenort/webcam.php?breite=640&amp;cache=1535204045"></i>
	</a>
	<a target="_blank" href="/webcam/grafenort/webcam.php?breite=1280&amp;cache=1535204045"><br> Klick auf das Bild für grosse Darstellung (1280x1024 Pixel) </a>
</p>

<p>
Information für Webdesigner<br>Es steht natürlich jedem frei die Flugsau Webcam Bilder auf eigenen Homepages einzubinden. Es müssen die verweisten PHP Dateien eingebunden werden, nur so zeigt die Kamera ein aktuelles Bild im Sekundentakt. Zusätzlich kann dem PHP File die Grösse (Breite) vom Bild als Attribut angegeben werden. So lassen sich z.B. auch schnell ladende Thumbnails oder Mobile Versionen darstellen. Die Pixel Angabe kann im Bereich von 300-1280 frei gewählt werden.<br><br><br>Wir helfen dir aber gerne die PHP Datei richtig einzubinden und anzupassen.<br>Fragen beantworten wir gerne: <a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');">info[at]flugsau[dot]ch
</a></p><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');">

</a><h3><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');"></a><a name="brunni">Brunni</a></h3>
<h4>Startplatz</h4>
<p>
	<a href="http://www.paragliding-brunni.ch/webcam/brunnihuette/webcam.php" target="_blank">
		<img src="http://www.paragliding-brunni.ch/webcam/brunnihuette/webcam.php" width="100%">
	</a>
</p>

<h4>Härzlisee &amp; Kräuterhütte (1860 MüM)</h4>
<p>
	<a href="http://www.brunni.ch/images/webcam/webcam05_gr.jpg?cache=1535204045" target="_blank">
		<img src="http://www.brunni.ch/images/webcam/webcam05_gr.jpg?cache=1535204045" width="100%">
	</a>
</p>

<h4>Bergstation Sessellift Brunnihütte (1860 MüM)</h4>
<p>
	<a href="http://www.brunni.ch/images/webcam/webcam03_gr.jpg?cache=1535204045" target="_blank">
		<img src="http://www.brunni.ch/images/webcam/webcam03_gr.jpg?cache=1535204045" width="100%">
	</a>
</p>

<h4>Familienrestaurant Ox (1050 MüM)</h4>
<p>
	<a href="http://www.brunni.ch/images/webcam/webcam02_gr.jpg?cache=1535204045" target="_blank">
		<img src="http://www.brunni.ch/images/webcam/webcam02_gr.jpg?cache=1535204045" width="100%">
	</a>
</p>

<h3><a name="klewenalp">Klewenalp</a></h3>
<h4>Klewenalp, Richtung See</h4>
<p>
	<a href="http://en.swisswebcams.ch/webcam/zoom/1315931735-Klewenalp-%286375-Beckenried%29_Weather" target="_blank">
		<img src="http://en.swisswebcams.ch/redirect?webcamid=1315931735&amp;cache=1535204045" alt="Klewenalp, Richtung See" width="100%">
	</a>
</p>

<h4>Stockhütte, Richtung See</h4>
<p>
	<a href="http://en.swisswebcams.ch/webcam/zoom/1047641268-Emmetten-Stockh%C3%BCtte-Blick-auf-Vierwaldst%C3%A4ttersee-%286376-Emmetten%29_Weather" target="_blank">
		<img src="https://images.webcams.travel/original/1047641268.jpg?cache=1535204045" alt="StockhÃ¼tte, Richtung See" width="100%">
	</a>
</p>

<h4>Beckenried Dorf</h4>
<p>
	<a href="http://en.swisswebcams.ch/webcam/zoom/1292514093-Beckenried-Dorf-%286375-Beckenried%29_Weather" target="_blank">
		<img src="https://images.webcams.travel/original/1292514093.jpg?cache=1535204045" alt="Beckenried Dorf" width="100%">
	</a>
</p>

																			<br>

		                            </div>
HTML;

            $page9 = $this->_pageFactory->create();
            $page9->setTitle('Webcams')
                    ->setContentHeading('Webcams')
                    ->setIdentifier('webcams')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([0])
                    ->setContent($webcams)
                    ->save();

            $shipping_de = <<<HTML
  <p><span>Lieferungen in die Schweiz:</span></p>
<p>Innerhalb der Schweiz versenden wir unsere Ware mit der Schweizer Post.<br><br>Packet bis 2kg: CH 11.-<br>Packet bis 10kg: CHF 14.-<br>Packet bis 30kg: CHF 27.-<br>Preise inklusive 8% MwSt</p>
<p><span>Lieferungen ins Ausland:</span></p>
<table border="1">
<tbody>
<tr>
<td>Gewicht</td>
<td>Zone 1</td>
<td>Zone 2</td>
<td>Zone 3</td>
<td>Zone 4</td>
<td>Zone5</td>
</tr>
<tr>
<td>0-0.5kg</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
</tr>
<tr>
<td>0.5-2kg</td>
<td>CHF 46.-</td>
<td>CHF 53.-</td>
<td>CHF 57.-</td>
<td>CHF 64.-</td>
<td>CHF 76.-</td>
</tr>
<tr>
<td>2-5kg</td>
<td>CHF 56.-</td>
<td>CHF 66.-</td>
<td>CHF 78.-</td>
<td>CHF 96.-</td>
<td>CHF 114.-</td>
</tr>
<tr>
<td>5-10kg</td>
<td>CHF 64.-</td>
<td>CHF 80.-</td>
<td>CHF 108.-</td>
<td>CHF 138.-</td>
<td>CHF 169.-</td>
</tr>
<tr>
<td>10-15kg</td>
<td>CHF 75.-</td>
<td>CHF 98.-</td>
<td>CHF 133.-</td>
<td>CHF 189.-</td>
<td>CHF 231.-</td>
</tr>
<tr>
<td>15-20kg</td>
<td>CHF 80.-</td>
<td>CHF 110.-</td>
<td>CHF 169.-</td>
<td>CHF 239.-</td>
<td>CHF 307.-</td>
</tr>
</tbody>
</table>
<p><span><a target="_blank" href="/downloads/versandzonen.pdf"><span>-&gt; Download Zonenplan/Länderinformation mit Beförderungszeit</span></a></span></p>
<p>Achtung:<br>Für Bestellungen aus dem Ausland entfällt die MwSt/UST. Diese wird nach der Auslieferung direkt vom Spediteur nach regionalen Steuersätzen eingefordert. Zusätzlich zur regionalen MwSt/UST werden vom Spediteur meistens geringe Kommision und Ausfuhr/Verzollungskosten verrechnet. Unsere Preisangaben sind exklusive MwSt/UST, Versand und Verzollungsgebühren. Mehr Informationen auf www.swisspost.com</p>
HTML;

            $page10 = $this->_pageFactory->create();
            $page10->setTitle('Versandkosten')
                    ->setContentHeading('Versandkosten')
                    ->setIdentifier('shipping')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($shipping_de)
                    ->save();

            $shipping_en = <<<HTML
<p>Delivery in Switzerland:</p>
<p><span>Within Switzerland we deliver our goods with the Swiss Post.</span><br><span> Parcel till 2kg: CHF 11.-</span><br><span> Parcel till 10kg: CHF 14.-</span><br><span> Prices include 8% VAT</span></p>
<p>Overseas delivery:</p>
<table border="1">
<tbody>
<tr>
<td>Weight</td>
<td>Zone 1</td>
<td>Zone 2</td>
<td>Zone 3</td>
<td>Zone 4</td>
<td>Zone5</td>
</tr>
<tr>
<td>0-0.5kg</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
</tr>
<tr>
<td>0.5-2kg</td>
<td>CHF 46.-</td>
<td>CHF 53.-</td>
<td>CHF 57.-</td>
<td>CHF 64.-</td>
<td>CHF 76.-</td>
</tr>
<tr>
<td>2-5kg</td>
<td>CHF 56.-</td>
<td>CHF 66.-</td>
<td>CHF 78.-</td>
<td>CHF 96.-</td>
<td>CHF 114.-</td>
</tr>
<tr>
<td>5-10kg</td>
<td>CHF 64.-</td>
<td>CHF 80.-</td>
<td>CHF 108.-</td>
<td>CHF 138.-</td>
<td>CHF 169.-</td>
</tr>
<tr>
<td>10-15kg</td>
<td>CHF 75.-</td>
<td>CHF 98.-</td>
<td>CHF 133.-</td>
<td>CHF 189.-</td>
<td>CHF 231.-</td>
</tr>
<tr>
<td>15-20kg</td>
<td>CHF 80.-</td>
<td>CHF 110.-</td>
<td>CHF 169.-</td>
<td>CHF 239.-</td>
<td>CHF 307.-</td>
</tr>
</tbody>
</table>
<p><span><span><a href="/downloads/versandzonen.pdf"><span>-&gt; Download <span id="result_box" lang="en"><span>Zone plan</span><span>/</span><span>country information</span> <span>with</span> <span>transport</span> <span>time</span></span></span></a></span><br></span></p>
<p>Warning:<br><span> For orders outside Switerland the Swiss value added taxes may be amended. These are claimed directly by the shipper according to regional rate of taxes after delivery. Additionally the shipper may claim commissions and export costs/ payment of duty. Our prices exclude value added taxes, shipping costs or payments of duty. More information on <a href="http://www.swisspost.com">www.swisspost.com</a></span></p>
HTML;

            $page11 = $this->_pageFactory->create();
            $page11->setTitle('Shipping Costs')
                    ->setContentHeading('Shipping Costs')
                    ->setIdentifier('shipping')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($shipping_en)
                    ->save();

            $privacy_de = <<<HTML
  <h4><span></span>Haftung für die Online-Verbindungen</h4>
<div></div>
<p><span></span>Die Firma Flugsau GmbH verpflichtet sich, in Systemen, Programmen usw., die ihm gehören und auf die er Einfluss hat, für Sicherheit nach aktuellem technischen Stand zu sorgen sowie die Regeln des Datenschutzes zu befolgen.</p>
<p><span></span>Die Kunden haben für die Sicherheit der Systeme, Programme und Daten zu sorgen, die sich in ihrem Einflussbereich befinden. Die Kunden sollten in eigenem Interesse Passwörter, Benutzernamen Rabatte und Margen gegenüber Dritten geheim halten.</p>
<p><span></span>Die Firma Flugsau GmbH haftet nicht für Mängel und Störungen, die sie nicht zu vertreten hat, vor allem nicht für Sicherheitsmängel und Betriebsausfälle von Drittunternehmen, mit denen sie zusammenarbeitet oder von denen sie abhängig ist.</p>
<p><span></span>Weiter haftet die Firma Flugsau GmbH nicht für höhere Gewalt, unsachgemässes Vorgehen und Missachtung der Risiken seitens des Kunden oder Dritter, übermässige Beanspruchung, ungeeignete Betriebsmittel des Kunden oder Dritter, extreme Umgebungseinflüsse, Eingriffe des Kunden oder Störungen durch Dritte, die trotz der notwendigen aktuellen Sicherheitsvorkehrungen passieren.</p>
HTML;

            $page12 = $this->_pageFactory->create();
            $page12->setTitle('Privatsphäre & Datenschutz')
                    ->setContentHeading('Privatsphäre & Datenschutz')
                    ->setIdentifier('privacy')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($privacy_de)
                    ->save();

            $privacy_en = <<<HTML
                <p>Liability for online connections<br> <br><span> The Company Flugsau GmbH undertakes in systems, programs, etc., which belong to him and which he has influence to ensure security on the current state of technology, and to follow the rules of data protection.</span><br> <br> <br><span> The Customer must ensure the security of systems, programs and data that are located in their area of ​​influence. Customers should hide passwords, user names, margins and discounts to third parties confidential.</span><br> <br> <br><span> The Company Flugsau is not liable for defects and malfunctions which they can not be held, especially not for security lapses and operational failures of third party companies.</span><br> <br> <br><span> Further, the company Flugsau GmbH is not liable for acts of higher forces, improper procedure and disregard of the risks by the customer or third parties, excessive strain, unsuitable equipment of the customer or third parties, extreme environmental conditions, the customer intervention or interference by third parties (viruses, worms, etc. ) that happen despite the current necessary safety precautions.</span></p>
HTML;

            $page13 = $this->_pageFactory->create();
            $page13->setTitle('Privacy Notice')
                    ->setContentHeading('Privacy Notice')
                    ->setIdentifier('privacy')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($privacy_en)
                    ->save();

            $returns_en = <<<HTML
                <p><span id="result_box" lang="en"><span>Right of withdrawal and</span> <span>rescission</span><br><br><span>The</span> <span>customer</span> <span>can</span> <span>withdraw from the</span> <span>contract</span> <span>with written</span> <span>notice for any reason</span> <span>within 7</span> <span>days.</span> <span>The</span> <span>period for exercise of</span> <span>this right shall begin</span> <span>on the date</span> <span>on which the</span> <span>product is received</span> <span>by the consumer.</span> <span>Excluded</span> <span>are custom</span> <span>product</span> <span>and</span> <span>are</span> <span>carried out at</span> <span>the</span> <span>customer</span><span>-specific adaptations</span><span>.</span> <span>Shipping</span> <span>costs</span> <span>for the return shipment</span> <span>shall be borne by</span> <span>the customer.</span><br><br><span>If a</span> <span>customer cancels the</span> <span>purchase</span> <span>due to late delivery</span> <span>or defects in the</span> <span>goods</span> <span>or other reasons</span> <span>for which the</span> <span>company</span> <span>is</span> <span>responsible</span> <span>Flugsau</span> <span>GmbH</span><span>,</span> <span>the company</span> <span>will refund</span> <span>Flugsau</span> <span>GmbH</span> <span>amounts already paid</span> <span>and the</span> <span>cost of return</span><span>.</span></span></p>
HTML;

            $page14 = $this->_pageFactory->create();
            $page14->setTitle('Right of Returns')
                    ->setContentHeading('Right of Returns')
                    ->setIdentifier('returns')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($returns_en)
                    ->save();

            $terms_de = <<<HTML
  <p><br><span>AGB Flugsau GmbH</span><br><br>&nbsp;<br><span>1. Geltung der AGB und Vertragsabschluss</span><br><br>1.1 Diese allgemeinen Geschäftsbedingungen (AGB) gelten für Kaufverträge jeder Art (Webseite, Telefon, E-Mail, Brief) mit Privatkunden und Unternehmen..<br><br>1.2 Für Kaufverträge, die auf andere Art, z.B. per Telefon, E-Mail oder Brief abgeschlossen werden, gelten diese AGB ebenfalls. Die Kunden werden in der Auftragsbestätigung darauf hingewiesen, wo sie die AGB im Internet herunterladen können. Falls ein Kunde in solchen Fällen nicht mit den AGB einverstanden ist, kann er sein Rücktrittsrecht in Anspruch nehmen, siehe Ziffer 5.3.<br><br><br><br><span>2. Preise und Sonderangebote</span><br><br>2.1 Die Preise werden in CHF angegeben. Vorgezogene Recyclinggebühr sowie Bearbeitung sind inbegriffen. Versandkosten werden extra verrechnet.<br><br>2.2 Die Firma Flugsau GmbH behält sich das Recht vor, die Preise jederzeit zu ändern.<br><br>2.3 Die Bedingungen für Aktionen und Rabatte sind bei den betreffenden Informationen abrufbar.<br><br>2.4 Unsere Preisangaben sind inklusive Schweizer Mehrwertsteuer, andere Preisangaben sind exklusive MwSt.<br><br>2.5 Für Bestellungen aus dem Ausland entfällt die MwSt/UST Diese wird nach der Auslieferung direkt vom Spediteur nach regionalen Steuersätzen eingefordert. Zusätzlich zur regionalen MwSt/UST werden vom Spediteur meistens geringe Kommision und Ausfuhr/Verzollungskosten verrechnet. Unsere Preisangaben sind exklusive MwSt/UST, Versand und Verzollungsgebühren. Mehr Informationen auf www.swisspost.com<br><br><br><span>3. Lieferbedingungen</span><br><br>3.1 Die Lieferung erfolgt so rasch wie möglich.</p>
<p>3.2 Versandskosten<br><br><span>Lieferungen in die Schweiz:</span></p>
<p>Innerhalb der Schweiz versenden wir unsere Ware mit DPD und der Schweizer Post.<br><br>Maxibrief/Packet leichter als 250g: CH 7.50<br>Packet bis 1kg: CHF 11.-<br>Packet bis 31kg: CHF 16.-<br>Preise inkl. 8% MwSt.</p>
<p><span>Lieferungen ins Ausland:</span></p>
<table border="1">
<tbody>
<tr>
<td>Gewicht</td>
<td>Zone 1</td>
<td>Zone 2</td>
<td>Zone 3</td>
<td>Zone 4</td>
<td>Zone5</td>
</tr>
<tr>
<td>0-0.5kg</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
</tr>
<tr>
<td>0.5-2kg</td>
<td>CHF 46.-</td>
<td>CHF 53.-</td>
<td>CHF 57.-</td>
<td>CHF 64.-</td>
<td>CHF 76.-</td>
</tr>
<tr>
<td>2-5kg</td>
<td>CHF 56.-</td>
<td>CHF 66.-</td>
<td>CHF 78.-</td>
<td>CHF 96.-</td>
<td>CHF 114.-</td>
</tr>
<tr>
<td>5-10kg</td>
<td>CHF 64.-</td>
<td>CHF 80.-</td>
<td>CHF 108.-</td>
<td>CHF 138.-</td>
<td>CHF 169.-</td>
</tr>
<tr>
<td>10-15kg</td>
<td>CHF 75.-</td>
<td>CHF 98.-</td>
<td>CHF 133.-</td>
<td>CHF 189.-</td>
<td>CHF 231.-</td>
</tr>
<tr>
<td>15-20kg</td>
<td>CHF 80.-</td>
<td>CHF 110.-</td>
<td>CHF 169.-</td>
<td>CHF 239.-</td>
<td>CHF 307.-</td>
</tr>
</tbody>
</table>
<p><span><a target="_blank" href="/downloads/versandzonen.pdf"><span>-&gt; Download Zonenplan/Länderinformation mit Beförderungszeit</span></a></span></p>
<p>Achtung:<br>Für Bestellungen aus dem Ausland entfällt die MwSt/UST. Diese wird nach der Auslieferung direkt vom Spediteur nach regionalen Steuersätzen eingefordert. Zusätzlich zur regionalen MwSt/UST werden vom Spediteur meistens geringe Kommision und Ausfuhr/Verzollungskosten verrechnet. Unsere Preisangaben sind exklusive MwSt/UST, Versand und Verzollungsgebühren. Mehr Informationen auf www.swisspost.com<br><br><br><span>4. Widerrufsrecht und Rücktrittsrecht</span><br><br>4.1 Die Kunden können den Kaufvertrag mit schriftlicher Angabe von Gründen innerhalb von 7 Tagen widerrufen. Die Frist für die Wahrnehmung dieses Rechts beginnt an dem Tag, an dem die Ware beim Verbraucher eintrifft. Davon ausgeschlossen sind Spezialanfertigungen und Ware bei der Kundenspezifische Anpassungen ausgeführt worden sind. Versandskosten für die Rücksendung gehen zu Lasten des Kunden.<br><br><br>4.2 Wenn ein Kunde vom Kauf zurücktritt wegen verspäteter Lieferung oder Mängel an den Waren oder sonstigen Gründen, für die die Firma Flugsau GmbH verantwortlich ist, erstattet die Firma Flugsau GmbH bereits bezahlte Beträge sowie die Rücksendungskosten zurück.<br><br><br><br><span>5. Haftung und Garantie</span><br><br>5.1 Die Firma Flugsau GmbH garantiert für die Dauer von 12 Monaten, dass die Ware die zugesicherten Eigenschaften aufweist, keine ihren Wert oder Tauglichkeit zum vorausgesetzten Gebrauch beeinträchtigende Mängel hat sowie den vorgeschriebenen Leistungen und Spezifikationen entspricht.<br><br><br>5.2 Der Käufer hat die gelieferte Ware so rasch wie möglich zu prüfen und Mängel sofort zu melden. Den zuständigen Kundendienst findet man unter www.flugsau.ch. Geheime Mängel können auch nach Inbetriebnahme bzw. Verwendung der Ware noch beanstandet werden. Die Leistung von Zahlungen gilt nicht als Verzicht auf Mängelrüge.<br><br><br>5.3 Liegt ein Mangel vor, so hat der Käufer die Wahl, unentgeltliche Nachbesserung zu verlangen, einen dem Minderwert entsprechenden Abzug vom Preis zu machen, vom Vertrag zurückzutreten oder Ersatzlieferung zu verlangen. Es besteht kein Recht des Käufers, Schadenersatz zu verlangen.<br><br><br>5.4 Der Garantieanspruch verfällt bei unsachgemässer Anwendung und Missachtung der Risiken seitens des Kunden oder Dritter, übermässige Beanspruchung, ungeeignete Betriebsmittel des Kunden oder Dritter, extreme Umgebungseinflüsse, Eingriffe des Kunden oder Störungen durch Dritte.<br><br><br><br><span>6. Zahlung</span><br><br>6.1 Die Zahlung ist auf Wunsch der Kunden auf folgende Arten möglich:</p>
<p><img src="{{media url="wysiwyg/paypallogo.png"}}" width="200"><br><br>Ausserhalb der Schweiz:<br>* Paypal (Kreditkarten, Mastercard, Visa etc.)<br>* Vorauszahlung</p>
<p>Innerhalb der Schweiz:<br>* Paypal (Kreditkarten, Mastercard, Visa etc.)<br>* Rechnung<br><br>Bitte überweisen Sie den Betrag innerhalb von 10 Tagen ab Lieferdatum auf das folgende Konto:<br><br>Raiffeisen Region Stans<br>Kto.-Nr.: 60-7178-4<br>BC-Nr.: 81223<br><br>Flugsau GmbH<br>Älplerhaus 3<br>6388 Grafenort<br><br>SWIFT: RAIFCH22<br>IBAN: CH72 8122 3000 0072 2095 1<br><br>Falls die Bezahlung nicht Fristgemäss eintrifft werden die folgenden Mahngebühren erhoben:<br>1. Mahnung nach 10 Tagen: CHF 20.-<br>2. Mahnung nach 30 Tagen: CHF 30.-<br><br>Die Ware bleibt bis zur vollständigen Bezahlung Eigentum der Firma Flugsau GmbH, Grafenort. <br><br>6.2 Bei verspäteter Zahlung wird die Firma Flugsau GmbH höchstens zwei Mahnungen verschicken. Für die erste Mahnung nach 10 Tagen wird eine Gebühr von CHF 20.- und für die zweite Mahnung nach 30 Tagen eine Gebühr von CHF 30.- verrechnet. Bezahlt der Kunde dann nicht, werden betreibungsrechtliche Massnahmen eingeleitet. Ausserdem werden bei verspäteter Zahlung Verzugszinsen von 5% Prozent berechnet. Schadenersatzforderungen bleiben vorbehalten.<br><br><br><br><span>7. Haftung für die Online-Verbindungen</span><br><br>7.1 Die Firma Flugsau GmbH verpflichtet sich, in Systemen, Programmen usw., die ihm gehören und auf die er Einfluss hat, für Sicherheit nach aktuellem technischen Stand zu sorgen sowie die Regeln des Datenschutzes zu befolgen.<br><br><br>7.2 Die Kunden haben für die Sicherheit der Systeme, Programme und Daten zu sorgen, die sich in ihrem Einflussbereich befinden. Die Kunden sollten in eigenem Interesse Passwörter, Benutzernamen Rabatte und Margen gegenüber Dritten geheim halten.<br><br><br>7.3 Die Firma Flugsau GmbH haftet nicht für Mängel und Störungen, die sie nicht zu vertreten hat, vor allem nicht für Sicherheitsmängel und Betriebsausfälle von Drittunternehmen, mit denen sie zusammenarbeitet oder von denen sie abhängig ist.<br><br><br>7.4 Weiter haftet die Firma Flugsau GmbH nicht für höhere Gewalt, unsachgemässes Vorgehen und Missachtung der Risiken seitens des Kunden oder Dritter, übermässige Beanspruchung, ungeeignete Betriebsmittel des Kunden oder Dritter, extreme Umgebungseinflüsse, Eingriffe des Kunden oder Störungen durch Dritte (Viren, Würmer usw.), die trotz der notwendigen aktuellen Sicherheitsvorkehrungen passieren.<br><br><br><br><span>8. Rechtsanwendung und Gerichtsstand</span><br><br>8.1 Für diese AGB gilt schweizerisches Recht, namentlich die Regelungen des OR.<br><br><br>8.2 Für Klagen eines Kunden ist das Gericht am Wohnsitz oder Sitz einer der Parteien zuständig. Für Klagen der Firma Flugsau GmbH ist das Gericht am Wohnsitz der beklagten Partei zuständig.<br><br>Für ausländische Kunden sind nach dessen Wahl die Gerichte am Wohnsitz des Kunden oder am Sitz des Anbieters zuständig. Für eine Klage der Firma Flugsau GmbH gegen den Kunden sind die Gerichte am Wohnsitz des Kunden zuständig.<br><br><br></p>
<div>Flugsau GmbH, Älplerhaus, 6388 - Grafenort, Schweiz<br>Tel 0041 (0)41 637 09 39</div>
<div><a href="javascript:linkTo_UnCryptMailto('nbjmup;jogpAgmvhtbv/di');">info[at]flugsau[dot]ch</a></div>
<div><a>www.flugsau.ch</a></div>
<p><br>&nbsp;<br><br><br></p>
HTML;

            $page15 = $this->_pageFactory->create();
            $page15->setTitle('Allgemeine Geschäftsbedingungen (AGB)')
                    ->setContentHeading('Allgemeine Geschäftsbedingungen (AGB)')
                    ->setIdentifier('terms-and-conditions')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($terms_de)
                    ->save();


            $terms_en = <<<HTML
  <p>Terms and conditions Flugsau GmbH</p>
<p></p>
<p>1. Application of terms and conditions and conclusion of contract</p>
<p><span>1.1 Any delivery of goods and services (to private customers or corporations) by us shall be subject to the Terms and Conditions set forth herein to the extent no other agreements have been explicitly made. As far as the client’s general terms and conditions are inconsistent with ours, their application shall be subject to our explicit written approval. <br></span></p>
<p><span>1.2 Agreements of sale, which are made through other means e.g. telefon, fax or letter shall also be subject to the Terms and Conditions set forth herein. During confirmation of the order the Terms and Conditions are pointed out to the client. If the customer does not agree to the Terms and Conditions he may make use of his right of withdrawal (see paragraph 5.3)</span></p>
<p></p>
<p>2. Prices and special offers</p>
<p><span>2.1 Prices are indicated in CHF. Advanced fees for recycling and handling are included. Shipping costs are to be paid additionally.</span></p>
<p><span><br>2.2 The Flugsau GmbH reserves the right to change the prices any time.</span></p>
<p><span><br>2.3 The conditions for special offers and sales discounts can be retrived aside the respective information.</span></p>
<p><span><br>2.4 List prices include Swiss value added taxes. Other prices are exclusive the value added taxes.</span></p>
<p><span><br>2.5 For orders outside Switerland the Swiss value added taxes may be amended. These are claimed directly by the shipper according to regional rate of taxes after delivery. Additionally the shipper may claim commissions and export costs/ payment of duty. Our prices exclude value added taxes, shipping costs or payments of duty. More information on <a href="http://www.swisspost.com">www.swisspost.com</a></span></p>
<p><span>&nbsp;</span></p>
<p>&nbsp;3. Conditions of delivery</p>
<p><span>3.1 Delivery may affect as soon as possible.</span></p>
<p><span>3.2 Cost of shipment <br></span></p>
<p>Delivery in Switzerland:</p>
<p><span>Within Switzerland we deliver our goods with DPD and the Swiss Post.</span></p>
<p><span>Maxibrief/Parcel lighter than 250g: CH 7.50</span><br><span> Parcel till 1kg: CHF 11.-</span><br><span> Parcel till 31kg: CHF 16.-</span><br><span> Prices include 8% VAT</span></p>
<p>Overseas delivery:</p>
<table border="1">
<tbody>
<tr>
<td>Weight</td>
<td>Zone 1</td>
<td>Zone 2</td>
<td>Zone 3</td>
<td>Zone 4</td>
<td>Zone5</td>
</tr>
<tr>
<td>0-0.5kg</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
<td>CHF 25.-</td>
</tr>
<tr>
<td>0.5-2kg</td>
<td>CHF 46.-</td>
<td>CHF 53.-</td>
<td>CHF 57.-</td>
<td>CHF 64.-</td>
<td>CHF 76.-</td>
</tr>
<tr>
<td>2-5kg</td>
<td>CHF 56.-</td>
<td>CHF 66.-</td>
<td>CHF 78.-</td>
<td>CHF 96.-</td>
<td>CHF 114.-</td>
</tr>
<tr>
<td>5-10kg</td>
<td>CHF 64.-</td>
<td>CHF 80.-</td>
<td>CHF 108.-</td>
<td>CHF 138.-</td>
<td>CHF 169.-</td>
</tr>
<tr>
<td>10-15kg</td>
<td>CHF 75.-</td>
<td>CHF 98.-</td>
<td>CHF 133.-</td>
<td>CHF 189.-</td>
<td>CHF 231.-</td>
</tr>
<tr>
<td>15-20kg</td>
<td>CHF 80.-</td>
<td>CHF 110.-</td>
<td>CHF 169.-</td>
<td>CHF 239.-</td>
<td>CHF 307.-</td>
</tr>
</tbody>
</table>
<p><span><span><a href="/downloads/versandzonen.pdf"><span>-&gt; Download <span id="result_box" lang="en"><span>Zone plan</span><span>/</span><span>country information</span> <span>with</span> <span>transport</span> <span>time</span></span></span></a></span><br></span></p>
<p>Warning:<br><span> For orders outside Switerland the Swiss value added taxes may be amended. These are claimed directly by the shipper according to regional rate of taxes after delivery. Additionally the shipper may claim commissions and export costs/ payment of duty. Our prices exclude value added taxes, shipping costs or payments of duty. More information on <a href="http://www.swisspost.com">www.swisspost.com</a></span></p>
<p><br>4. Right of rescission and withdrawal</p>
<p><br><span> 4.1 The customer may rescind the contract within 7 days if written reasons for the withdrawal are exhibited. The time limit for the appreciation of this right starts with the day the goods arrive at the shipment address. Excluded are custom products and goods, which were modified client specifically. Shipment costs for the return of goods are charged to the client’s account.&nbsp;</span></p>
<p><span>4.2 If the customer withdraws due to reasons, which Flugsau GmbH is accountable for (e.g. delayed delivery, defect of goods), Flugsau GmbH will reimburse already made payments as well as shipment costs for the return of goods.</span></p>
<p></p>
<p>5 Liability and Warranty<br> <br><span> 5.1 The Company Flugsau GmbH guarantees for a period of 12 months, that the product has the guaranteed properties, their value or suitability for the intended use and has no defects affecting the prescribed performance and specifications.</span><br> <br> <br><span> 5.2 The Buyer shall inspect the goods as soon as possible and to report defects immediately. The relevant customer service can be found at www.flugsau.ch. Hidden defects can be challenged even after commissioning or use of the goods. The performance of payments does not constitute a waiver of notice of defects.</span><br> <br> <br><span> 5.3 If a defect exists, the buyer has the option to request free repair, to make a corresponding deduction from the price of the loss in value, to rescind the contract or to demand a replacement. There is no right of the buyer to claim damages.</span><br> <br><span> 5.4 The warranty expires by improper use and disregard of the risks by the customer or third parties, excessive strain, unsuitable equipment of the customer or third parties, extreme environmental conditions, customer intervention or interference by third parties.</span></p>
<p><br> <br> 6 payment<br> <br><span> 6.1 Payment is possible in the following ways:</span></p>
<p><span><img src="{{media url="wysiwyg/paypallogo.png"}}" width="200"></span></p>
<p><span>Outside Switzerland:</span><br><span> * Paypal (credit cards, Mastercard, Visa, etc.)</span><br><span> &nbsp;* Prepayment</span></p>
<p><span>Inside Switzerland:</span><br><span> * Paypal (credit cards, Mastercard, Visa, etc.)</span><br><span> &nbsp;* Invoice</span></p>
<p><span><span id="result_box" lang="en"><span>Please transfer</span> <span>the amount within</span> <span>10 days of delivery</span> <span>to the following account</span><span>:</span></span></span></p>
<p><span>Raiffeisen Region Stans</span><br><span> Kto.-Nr.: 60-7178-4</span><br><span> BC-Nr.: 81223</span><br> <br><span> Flugsau GmbH</span><br><span> Älplerhaus 3</span><br><span> 6388 Grafenort</span><br> <br><span> SWIFT: RAIFCH22</span><br><span> IBAN: CH72 8122 3000 0072 2095 1</span><br> <br><span> If payment is not received accordance with applicable deadline, we charge the following fees:<br>1st Reminder after 10 days: CHF 20.-</span><br><span> 2nd Reminder after 30 days: CHF 30.-</span><br> <br><span> Until the complete payment, the commodity remains property of the company Flugsau GmbH, Grafenort.</span><br> <br><span> 6.2 In the event of late payment to the company Flugsau GmbH, we will send a maximum of two reminders. For the first reminder after 10 days, a fee of CHF 20, - and for the second reminder after 30 days, a fee of CHF 30, - will be charged. If the customer still dont pay, legal debt enforcement measures are initiated. In addition, default interest of 5% per cent will be charged for late payment. Right to claim damages reserved.</span><br> <br> <br> <br> 7 Liability for online connections<br> <br><span> 7.1 The Company Flugsau GmbH undertakes in systems, programs, etc., which belong to him and which he has influence to ensure security on the current state of technology, and to follow the rules of data protection.</span><br> <br> <br><span> 7.2 The Customer must ensure the security of systems, programs and data that are located in their area of ​​influence. Customers should hide passwords, user names, margins and discounts to third parties confidential.</span><br> <br> <br><span> 7.3 The Company Flugsau is not liable for defects and malfunctions which they can not be held, especially not for security lapses and operational failures of third party companies.</span><br> <br> <br><span> 7.4 Further, the company Flugsau GmbH is not liable for acts of higher forces, improper procedure and disregard of the risks by the customer or third parties, excessive strain, unsuitable equipment of the customer or third parties, extreme environmental conditions, the customer intervention or interference by third parties (viruses, worms, etc. ) that happen despite the current necessary safety precautions.</span><br> <br> <br> <br> 8 Application of law and jurisdiction<br> <br><span> 8.1 In these terms and conditions are governed by Swiss law, including the provisions of the Swiss OR.</span><br> <br> <br><span> 8.2 For claims of a client, the court of the domicile or principal place of one of the parties is responsible. For actions of the company Flugsau GmbH, the court of the domicile of the defendant is responsible.</span><br> <br><span> For foreign customers, the courts of the domicile of the customer or the location of the provider's option. For an action by the company Flugsau GmbH against the customer, the courts of the domicile of the customer are responsible.</span></p>
<p><span>&nbsp;</span></p>
<div>Flugsau GmbH, Älplerhaus, 6388 - Grafenort, Schweiz<br>Tel 041 637 09 39</div>
<div><a>info[at]flugsau[dot]ch</a></div>
<p><span><a>www.flugsau.ch</a></span></p>
HTML;

            $page16 = $this->_pageFactory->create();
            $page16->setTitle('Terms and Conditions')
                    ->setContentHeading('Terms and Conditions')
                    ->setIdentifier('terms-and-conditions')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([2])
                    ->setContent($terms_en)
                    ->save();

            $returns_de = <<<HTML
  <h4><span></span>Widerrufsrecht und Rücktrittsrecht</h4>
<div></div>
<p>Die Kunden können den Kaufvertrag mit schriftlicher Angabe von Gründen innerhalb von 7 Tagen widerrufen. Die Frist für die Wahrnehmung dieses Rechts beginnt an dem Tag, an dem die Ware beim Verbraucher eintrifft. Davon ausgeschlossen sind Spezialanfertigungen und Ware bei der Kundenspezifische Anpassungen ausgeführt worden sind. Versandskosten für die Rücksendung gehen zu Lasten des Kunden.</p>
<div></div>
<p></p>
<p>Wenn ein Kunde vom Kauf zurücktritt wegen verspäteter Lieferung oder Mängel an den Waren oder sonstigen Gründen, für die die Firma Flugsau GmbH verantwortlich ist, erstattet die Firma Flugsau GmbH bereits bezahlte Beträge sowie die Rücksendungskosten zurück.</p>
HTML;

            $page17 = $this->_pageFactory->create();
            $page17->setTitle('Widerrufsbelehrung')
                    ->setContentHeading('Widerrufsbelehrung')
                    ->setIdentifier('returns')
                    ->setIsActive(true)
                    ->setPageLayout('1column')
                    ->setStores([1])
                    ->setContent($returns_de)
                    ->save();
        }


        if (version_compare($context->getVersion(), '1.0.3') < 0) {
            $menu_before = <<<HTML
<ul>
    <li class="ui-menu-item level0">
        <a href="{{store url=''}}" class="level-top"><span>Home</span></a>
    </li>
    <li class="ui-menu-item level0">
        <a href="{{store url='news'}}" class="level-top"><span>News</span></a>
    </li>
</ul>
HTML;

            $customMenuBeforeBlock = $this->_blockFactory->create();
            $customMenuBeforeBlock->setIdentifier('custom_menu_before')
                ->setTitle('Custom Menu Before')
                ->setIsActive(true)
                ->setContent($menu_before)
                ->setStores([0])
                ->save();

            $menu_after_de = <<<HTML
<ul>
    <li class="ui-menu-item level0">
        <a href="{{store url='contact'}}" class="level-top"><span>Kontakt</span></a>
    </li>
</ul>
HTML;

            $customMenuAfterBlockDe = $this->_blockFactory->create();
            $customMenuAfterBlockDe->setIdentifier('custom_menu_after')
                ->setTitle('Custom Menu After')
                ->setIsActive(true)
                ->setStores([1])
                ->setContent($menu_after_de)
                ->save();


            $menu_after_en = <<<HTML
<ul>
    <li class="ui-menu-item level0">
        <a href="{{store url='contact'}}" class="level-top"><span>Contact</span></a>
    </li>
</ul>
HTML;

            $customMenuAfterBlockEn = $this->_blockFactory->create();
            $customMenuAfterBlockEn->setIdentifier('custom_menu_after')
                ->setTitle('Custom Menu After')
                ->setIsActive(true)
                ->setStores([2])
                ->setContent($menu_after_en)
                ->save();
        }

        $setup->endSetup();
    }
}
