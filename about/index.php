<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Компания Анкорн уже более 10 лет поставляет в РФ высокоточное оборудование венгерского производителя промышленных приборов NIVELCO Process Control Co.");
$APPLICATION->SetPageProperty("title", "О компании АНКОРН - эксклюзивном дистрибьюторе НИВЕЛКО в России");
$APPLICATION->SetTitle("О компании");
?><section class="breadcrumbs">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
</div>
 </section> <section class="about-page p-50">
<div class="container">
	<div class="page-title">
		<h1>О компании «Анкорн»</h1>
	</div>
	<div class="about-description">
		<div class="about-description-left">
			<h2>Более 10 лет подбираем КИП и датчики уровня под реальные условия производства</h2>
			<p>
				 Помогаем предприятиям решать задачи контроля, измерения и автоматизации технологических процессов. Подбираем оборудование под конкретную среду, параметры эксплуатации и требования производства — без ошибок, переделок и лишних затрат.
			</p>
			<h2>Нам доверяют задачи, где ошибка стоит дорого</h2>
			<p>
				 Мы поставляем контрольно-измерительные приборы предприятиям:
			</p>
			<ul>
				<li>нефтегазовой отрасли</li>
				<li>химической промышленности</li>
				<li>металлургии</li>
				<li>машиностроения</li>
				<li>пищевого производства</li>
				<li>энергетики</li>
				<li>проектным институтам и интеграторам</li>
			</ul>
			<p>
				 Когда на производстве важна точность, стабильность и сроки — выбирают профессиональный подбор от “Анкорн”.
			</p>
			<p>
				 Мы помогаем подобрать решение, которое гарантированно будет работать в ваших условиях.
			</p>
			<h2>Что входит в нашу работу:</h2>
			<ul>
				<li>анализ задачи и параметров процесса</li>
				<li>подбор оборудования под среду, температуру и давление</li>
				<li>предложения нескольких рабочих вариантов</li>
				<li>помощь с внедрением и запуском</li>
				<li>консультации по эксплуатации</li>
				<li>сопровождение закупки до поставки</li>
			</ul>
		</div>
		<div class="about-description-right">
			<h2>К нам обращаются, когда:</h2>
			<ul>
				<li>установленный датчик работает нестабильно</li>
				<li>прибор подобран неверно и требует замены</li>
				<li>сложная среда: пена, налипание, вязкость</li>
				<li>нужен быстрый подбор без потери времени</li>
				<li>важно избежать простоев производства</li>
				<li>требуется надёжное решение под проект</li>
			</ul>
			<h2>Официальный поставщик <a href="https://nivelco.com/">NIVELCO</a> в России </h2>
			<p>
				 Гарантия оригинального оборудования, техническая поддержка и прямые цены производителя.
			</p>
			<p class="MsoNormal">
 <img width="794" alt="Sertifikat eksklyuzivnogo distribyutora NIVELCO.png" src="/upload/medialibrary/214/6m1yfbfii0etsdg6mk1nb1g2pbxdhs38/Sertifikat-eksklyuzivnogo-distribyutora-NIVELCO.png" height="1122" title="Sertifikat eksklyuzivnogo distribyutora NIVELCO.png">
			</p>
		</div>
	</div>
</div>
 </section>
<div class="container">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"advantages",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantages",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"ICON",2=>"",),
		"SEARCH_PAGE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
);?> 
</div>
<section class="about-page selection">


<div class="page-container">
	<div class="selection-inner" style="background-image: url(/local/templates/ankorn/img/selection-bg-mobile.jpg);">
		<div class="container">
			<div class="selection-columns">
				<div class="selection-column selection-column--left">
					<div class="selection-title">
						 Профессиональный подбор оборудования сэкономит деньги и время
					</div>
					<div class="selection-description">
						 Мы внимательно изучим задачу, расскажем о наших приборах и предложим подходящее для вашего предприятия решение.
					</div>
					<div class="selection-items">
						<div class="selection-item selection-item--1">
							<div class="selection-item-icon">
 <img width="79" alt="Доставка по всей России" src="/local/templates/ankorn/img/selection-1.svg" height="36">
							</div>
							<div class="selection-item-label">
								 Доставка по <br>
								 всей России
							</div>
						</div>
						<div class="selection-item selection-item--2">
							<div class="selection-item-icon">
 <img width="30" alt="Гарантия до 5 лет" src="/local/templates/ankorn/img/selection-2.svg" height="36">
							</div>
							<div class="selection-item-label">
								 Гарантия <br>
								 до 5 лет
							</div>
						</div>
					</div>
				</div>
				<div class="selection-column selection-column--right">
					<div class="selection-button">
 <button type="button" class="btn-red modal-selection">
						Подобрать прибор </button>
					</div>
					<div class="selection-text">
						 Вы можете задать вопрос <br>
						 специалисту прямо сейчас!
					</div>
				</div>
			</div>
		</div>
		<div class="page-lines">
			<div class="page-line page-line--1">
			</div>
			<div class="page-line page-line--2">
			</div>
			<div class="page-line page-line--3">
			</div>
			<div class="page-line page-line--4">
			</div>
			<div class="page-line page-line--5">
			</div>
		</div>
	</div>
</div>
 </section> 

<section class="clients p-50">
<div class="container">
	<div class="page-title">
		<h2>Нам доверяют предприятия по всей России</h2>
	</div>
</div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"clients-slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "clients-slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "home",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",2=>"",),
		"SEARCH_PAGE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
);?> </section> <section class="about-certificates">
<div class="container">
	<div class="about-certificates-title">
		 «Анкорн» - официальный <br>
		 дистрибьютор
	</div>
	<div class="field field--name-field-about-certificates field--type-entity-reference-revisions field--label-hidden about-certificates-list">
		<div class="about-certificates-item">
			<div class="paragraph certificate paragraph--type--certificate paragraph--view-mode--default">
 <a href="/local/templates/ankorn/img/ankorn_eksklyuzivnyy_distribyutor_1.jpg" target="_blank" class="certificate-image">
				<div class="field field--name-field-certificate-image field--type-image field--label-hidden field__item">
 <img width="176" src="/local/templates/ankorn/img/ankorn_eksklyuzivnyy_distribyutor_1.jpg" height="243" alt="" class="image-style-paragraph-certificate">
				</div>
 </a>
				<div class="field field--name-field-certificate-logo field--type-image field--label-hidden field__item">
 <img width="225" src="/local/templates/ankorn/img/logo_main_2x_pro.png" height="58" alt="" class="image-style-paragraph-certificate-logo">
				</div>
				<div class="field field--name-field-certificate-title field--type-string field--label-hidden field__item">
					 Венгерского приборостроительного завода «NIVELCO» в России.
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-lines">
	<div class="page-line page-line--1">
	</div>
	<div class="page-line page-line--2">
	</div>
	<div class="page-line page-line--3">
	</div>
	<div class="page-line page-line--4">
	</div>
	<div class="page-line page-line--5">
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>