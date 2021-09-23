@extends('layouts.web.app')

@section('content')
<style>
    .fakka-policy {
        display: flex;
        align-items: center;
    }

    .policy.en {
        text-align: left;
        width: 1000px;
        margin: 0 auto;
        padding-bottom: 112px;
        margin-left: 15px;
    }

    .policy.en h2 {
        font-size: 30px;
        font-weight: 600;
        padding-right: 16px;
        padding-bottom: 37px;
    }

    .policy.en p {
        display: flex;
        flex-direction: column;
    }

    .policy.en span {
        padding: 10px 30px;
        color: #015CAB;
        font-size: 20px;
        position: relative;
    }

    .policy.en .title::after {
        content: "";
        background: #015CAB;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: 5px;
        top: 22px;
    }

    .policy.en p {
        display: flex;
        flex-direction: column;
        font-size: 20px;
        font-weight: 500;
    }

    .policy.en .bold::after {
        content: unset;
    }

    .policy.en .bold {
        font-weight: 600;
        padding: 0;
        color: #000000;
    }

    .policy.en .subtitle {
        padding-right: 50px;
        font-size: 18px;
    }

    .policy.en .subtitle::after {
        content: "";
        background: #015CAB;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: 15px;
        top: 18px;
    }

    .policy.ar {
        text-align: right;
        width: 1000px;
        margin: 0 auto;
        padding-bottom: 112px;
    }

    .policy.ar h2 {
        font-size: 30px;
        font-weight: 600;
        padding-right: 16px;
        padding-bottom: 37px;
    }

    .paragraph {
        flex: 1;
        height: 250px;
        border: 1px solid #80ADD5;
        padding: 30px;
        overflow-y: scroll;
        margin-right: 15px;
        padding-top: 5px;
    }

    .policy.ar p {
        display: flex;
        flex-direction: column;
    }

    .policy.ar span {
        padding: 10px 30px;
        color: #015CAB;
        font-size: 20px;
        position: relative;
    }

    .policy.ar .title::after {
        content: "";
        background: #015CAB;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        right: 5px;
        top: 19px;
    }

    .policy.ar p {
        display: flex;
        flex-direction: column;
        font-size: 20px;
        font-weight: 500;
    }

    .policy.ar .bold::after {
        content: unset;
    }

    .policy.ar .bold {
        font-weight: 600;
        padding: 0;
        color: #000000;
    }

    .policy.ar .subtitle {
        padding-right: 50px;
        font-size: 18px;
    }

    .policy.ar .subtitle::after {
        content: "";
        background: #015CAB;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        right: 31px;
        top: 18px;
    }
</style>
<main>

    <div class="container">
        <br> <br>
        <div class="fakka-policy">
            <div class="policy en">
                <h2>
                    FAKKA Privacy Policy
                </h2>
                <div class="paragraph">
                    <p>
                        <span class="title">
                            Introduction
                        </span> FAKKA respects your privacy and is committed to protect Data. This Privacy Policy will inform you as to how we look after Data when you visit and use our Mobile Application and/or Website “App” (regardless
                        of where you visit it from) and tell you about your privacy rights and how the law protects you.
                        <span class="title">
                            Glossary
                        </span>
                        <span class="bold">
                            You OR Your:
                        </span> shall refer to the users of our App.
                        <span class="bold">
                            Data:
                        </span> the information that we collect from you while using the App.
                        <span class="bold">
                            Service:
                        </span> means the services provided through FAKKA ’s App.
                        <span class="title">
                            Important information and who we are
                        </span>
                        <span class="subtitle">
                            Purpose of this Privacy Policy
                        </span> This Privacy Policy aims to give you information on how FAKKA collects and processes Data through your use of our App, including any Data you may provide through this App when you register and/or
                        use our Services, as well as install and sign up to our App.
                        <span></span> This App is not intended for children who are below 16 years old, and we do not knowingly collect Data relating to children.
                        <span></span> It is important that you read this Privacy Policy along with our Terms and Conditions when we are collecting or processing Data about you so that you are fully aware of how and why we are using this Data. This
                        Privacy Policy supplements other notices and Privacy Policies and is not intended to override them.
                        <span class="subtitle">
                            Controller
                        </span> FAKKA LLC is the controller and responsible for Data (referred to as "FAKKA ", "we", "us" or "our" in this Privacy Policy). FAKKA is the controller and responsible for this App.
                        <span></span> If you have any questions about this Privacy Policy, please contact us using the details set out below.
                        <span class="subtitle">
                            Contact details
                        </span> If you have any questions about this Privacy Policy or our privacy practices, please contact us through the email address
                        <span></span> E-mail address: [info@fakka.org]

                        <span class="subtitle">
                            Changes to the Privacy Policy and your duty to inform us of changes
                        </span> We keep our Privacy Policy under regular review. It is important that the Data we hold about you is accurate and current. Please keep us informed if Data changes during your relationship with us.
                        <span class="subtitle">
                            Third-party Links
                        </span> This Platform (App) may include links to third-party websites, plug-ins and applications. Clicking on those links or enabling those connections may allow third parties to collect or share Data about
                        you. We do not control these third-party applications/websites and we are not responsible for their privacy statements. We recommend for you to read the Privacy Policy of every application/website you visit.
                        <span class="title">
                            Data that we collect
                        </span> Data means any information about an individual from which that person can be identified. It does not include Data where the identity has been removed (anonymous Data).
                        <span class="subtitle">
                            We may collect, use, store and transfer different kinds of Data about you which is
                            including, but not limited to the following:
                        </span> a) Identity Data includes first name, maiden name, username or similar identifier, date of birth and gender.
                        <span></span> b) Contact Data includes e-mail address and mobile number.
                        <span></span> c) Financial Data includes bank account and payment card details.
                        <span></span> d) Technical Data includes your login data, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you
                        use to access the App/Website.
                        <span></span> e) Profile Data includes your username and password, your interests, preferences, purchasing power, reviews and ratings, feedback and survey responses.
                        <span></span> f) Usage Data includes information about how you use our App.
                        <span></span> We also collect, use and share aggregated Data such as statistical or demographic Data for any purpose. Aggregated Data could be derived from Data but is not considered Data in law as this Data will not directly
                        or indirectly reveal your identity. For example, we may aggregate your usage Data to calculate the percentage of users accessing a specific App feature. However, if we combine or connect aggregated Data with Data so that it
                        can directly or indirectly identify you, we treat the combined Data as Data which will be used in accordance with this Privacy Policy.
                        <span></span> We do not collect any special categories of Data (this includes details about your race or ethnicity, religious or philosophical beliefs, sex life, sexual orientation, political opinions, trade union membership,
                        information about your health, and genetic and biometric Data). Nor do we collect any information about criminal convictions and offences.
                        <span class="title">
                            If you fail to provide Data
                        </span> Where we need to collect Data by law, by using our App, and you fail to provide the required Data, we may not be able to perform our Services. We will notify you if this is the case at the time.
                        <span class="title">
                            How is Data collected?
                        </span> We use different methods to collect Data from and about you including through:
                        <span class="subtitle">
                            Direct interactions. You may give us your Identity, contact and financial Data by
                            filling in forms or by corresponding with us by phone or e-mail or otherwise. This includes
                            Data you provide when you undertake the following:
                        </span> a. Create an account on, or exploit, our App;
                        <span></span> b. Enter a social competition, promotion or survey; or
                        <span></span> c. Provide us with feedback or contact us.
                        <span class="subtitle">
                            Automated technologies or interactions. As you interact with our App/Website, we will
                            automatically collect technical data about your browsing actions and patterns. We collect
                            this Data by using cookies, server logs and other similar technologies.
                        </span>
                        <span class="title">
                            How we use Data
                        </span>
                        <span class="subtitle">
                            We will only use Data when the law allows us to. Most commonly, we will use Data in the
                            following circumstances:
                        </span> a) Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.
                        <span></span> b) Where we need to comply with a legal obligation.
                        <span></span> c) Where we need to set up your account and administrate it.
                        <span></span> d) Where we need to carry out surveys.
                        <span></span> e) Where we need to personalize content, user experience or business information.
                        <span></span> f) Where you have given consent.
                        <span></span> Generally, we do not rely on consent as a legal basis for processing data although we will get your consent before sending third party direct marketing communications to you via e-mail or text message. You have
                        the right to withdraw consent to marketing at any time by contacting us.
                        <span class="title">
                            Purposes for which we will use Data
                        </span> A) Performance of our Services:
                        <span></span> We process Data because it is necessary for the performance of our Services through our App.
                        <span class="subtitle">
                            In this respect, we use Data for the following:
                        </span> i. To prepare a proposal for you regarding the Services we offer;
                        <span></span> ii. To provide you with the Services as set in the scope of our Services, or as otherwise agreed with you from time to time;
                        <span></span> iii. To deal with any complaints or feedback you may have;
                        <span></span> iv. For any other purpose for which you provide us with the Data which we collect.
                        <span class="subtitle">
                            In this respect, we may share Data with or transfer it to the following:
                        </span> i. Subject to your consent, independent third parties whom we engage with to assist in delivering the Services to you;
                        <span></span> ii. Our Professional Advisers where it is necessary for us to obtain their advice or assistance, including lawyers, accountants, IT or public relations advisers;
                        <span></span> iii. Our Data storage providers.
                        <span></span> The legal basis for the processing of Personal Data Protection Law N.151 of 2020 and aforementioned Data categories is Art. 6 (1) (a) of the European General Data Protection Regulation (GDPR). Due to the said
                        purposes, in particular to guarantee security and a smooth connection setup, we have a legitimate interest to process this Data.
                        <span></span> B) Legitimate interests:
                        <span></span> We also process Data because it is necessary for our legitimate interests, or sometimes where it is necessary for the legitimate interests of a third party.
                        <span></span> In this respect, we use Data for the administration and management of our business, marketing purposes, archiving or statistical analysis.

                        <span></span> C) Legal obligations:
                        <span class="subtitle">
                            We also process Data for our compliance with a legal obligation which we are under. In this
                            respect, we will use Data for the following:
                        </span> i. To meet our compliance and regulatory obligations;
                        <span></span> ii. As required by tax authorities or any competent court or legal authority.
                        <span class="subtitle">
                            D) Marketing:
                        </span> We will send you marketing about Services we provide which may be of interest to you, as well as other information in the form of alerts, newsletters, notifications for discounts and deals, or functions
                        which we believe might be of interest to you or in order to update you with information which we believe may be relevant to you. We will communicate this to you in a number of ways including by telephone, SMS, e-mail or other
                        digital channels as appropriate.
                        <span class="subtitle">
                            E) Promotional offers from us:
                        </span> We may use Data to form a view on what we think you may want or need, or what may be of interest to you. This is how we decide which merchants, products, Services, discounts and deals may be relevant
                        to you.
                        <span></span> You will receive marketing communications from us in case of using our App, and you have not opted out of receiving these marketing communications.
                        <span></span> F) Third-party marketing:
                        <span></span> i. We will get your express opt-in consent before we share Data with any third party for marketing purposes.
                        <span></span> ii. You can ask us or third parties to stop sending you marketing messages at any time by logging into the App and checking or unchecking relevant boxes to adjust your marketing preferences, or by following the
                        opt-out links on any marketing message sent to you or by contacting us at any time.
                        <span></span> G) Cookies:
                        <span></span> You can set your browser to refuse all or some browser cookies, or to alert you when Apps set or access cookies. If you disable or refuse cookies, please note that some parts of this App may become inaccessible
                        or not function properly.
                        <span></span> H) Change of purpose:
                        <span></span> We will only use Data for the purposes for which we collected it, unless we reasonably consider that we need to use it for another reason and that reason is compatible with the original purpose. If you wish to
                        get an explanation as to how the processing for the new purpose is compatible with the original purpose, please contacts us on the e-mail address [info@fakka.org]. If we need to use Data for an unrelated purpose, we will notify
                        you and we will explain the legal basis which allows us to do so. Please note that we may process Data without your knowledge or consent, in compliance with the above rules, where this is required or permitted by law.
                        <span></span> I) Opting out:
                        <span></span> Where you opt out of receiving these marketing messages, this will not apply to Data provided to us as a result of a redemption of a product/Service, warranty registration, Product/Service experience at a Merchant’s
                        Store or other relevant transactions.
                        <span class="title">
                            Disclosures of Data
                        </span> We may share Data with the parties set out in Article (6) in relation to the specified purposes for which we will use the Data above.
                        <span></span> We may share Data with third parties to whom we may choose to sell, transfer or merge parts of our business or our assets. Alternatively, we may seek to acquire other businesses or merge with them. If a change
                        happens to our business, then the new owners may use Data in the same way as set out in this Privacy Policy.
                        <span></span> We require all third parties to respect the security of Data and to treat it in accordance with the law. We do not allow our third-party service providers to use Data for their own purposes and only permit them
                        to process Data for specified purposes and in accordance with our instructions.
                        <span class="title">
                            Data security
                        </span> We have put in place appropriate security measures to prevent Data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. In addition, we limit access to Data
                        to those employees, contractors, third party service providers and other parties who have a valid need to know. They will only process Data in accordance with our instructions and they are subject to a duty of confidentiality.
                        <span></span> We have put in place procedures to deal with any suspected Data breach and will notify you and any applicable regulator of a breach where we are legally required to do so.
                        <span class="title">
                            Data retention
                        </span>
                        <span class="subtitle">
                            How long will we use Data?
                        </span> We will only retain Data for as long as reasonably necessary to fulfil the purposes we collected it for, including for the purposes of satisfying any legal, regulatory or reporting requirements.
                        We may retain Data for a longer period in the event of a complaint or if we reasonably believe there is a prospect of litigation in respect to our relationship with you.
                        <span></span> To determine the appropriate retention period for Data, we consider the amount, nature and sensitivity of the Data, the potential risk of harm from unauthorized use or disclosure of Data, the purposes for which
                        we process Data and whether we can achieve those purposes through other means, and the applicable legal, regulatory, or other requirements.
                        <span></span> When it is no longer necessary to retain Data, we will delete it.
                        <span class="title">
                            What we may need from you
                        </span> We may need to request specific information from you to help us confirm your identity and ensure your right to access Data (or to exercise any of your other rights). This is a security measure to
                        ensure that Data is not disclosed to any person who has no right to receive it. We may also contact you to ask you for further information to improve our Services.
                        <span class="title">
                            How do we deal with the “right to be forgotten”?
                        </span> You have the right to request the erasure of Data that we hold about you in certain circumstances, for example if it were not acquired for, or has ceased to be necessary for, a lawful purpose. This
                        is known as the right to be forgotten. Where you request that we erase your Data, we will usually only do so where the Data has ceased to be publicly available or where we no longer use it.
                        <span class="title">
                            LAWFUL BASIS
                        </span> Legitimate Interest means the interest of our business in conducting and managing our business to enable us to give you the best Service and the best and most secure experience. We make sure we consider
                        and balance any potential impact on you (both positive and negative) and your rights before we process Data or for our legitimate interests. We do not use Data for activities where our interests are overridden by the impact
                        on you (unless we have your consent or are otherwise required or permitted to by law). You can obtain further information about how we assess our legitimate interests against any potential impact on you in respect of specific
                        activities by contacting us.
                        <span></span> Comply with a legal obligation means processing Data where it is necessary for compliance with a legal obligation that we are subject to.
                        <span class="title">
                            THIRD PARTIES
                        </span> External Third Parties
                        <span></span> Service providers providing the Services throughout our App.
                        <span></span> Professional advisers acting as processors or joint controllers including lawyers, bankers and auditors as the case may be, who provide consultancy, banking, legal and accounting services.
                        <span class="title">
                            YOUR LEGAL RIGHTS
                        </span>
                        <span class="subtitle">
                            You have the right to:
                        </span> Access to Data on our App. This enables you to receive a copy of Data we hold about you and to check that we are lawfully processing it.
                        <span></span> Request correction of the Data that we hold about you. This enables you to have any incomplete or inaccurate Data we hold about you corrected, though we may need to verify the accuracy of the new Data you provide
                        to us.
                        <span></span> Request erasure of personal Data. This enables you to ask us to delete or remove Data where there is no good reason for us continuing to process it. You also have the right to ask us to delete or remove Data where
                        you have successfully exercised your right to object to processing (see below), where we may have processed your information unlawfully or where we are required to erase Data to comply with local law.
                        <span></span> Object to processing of Data where we are relying on a legitimate interest (or those of a third party) and there is something about your particular situation which makes you want to object to processing on this
                        ground as you feel it impacts on your fundamental rights and freedoms. You also have the right to object where we are processing Data for direct marketing purposes. In some cases, we may demonstrate that we have compelling
                        legitimate grounds to process your information which override your rights and freedoms.
                        <span class="subtitle">
                            Request restriction of processing of Data. This enables you to ask us to suspend the processing of Data in the following scenarios:
                        </span> • If you want us to establish the Data's accuracy.
                        <span></span> • Where our use of the Data is unlawful, but you do not want us to erase it.
                        <span></span> • Where you need us to hold the Data even if we no longer require it as you need it to establish, exercise or defend legal claims.
                        <span></span> • You have objected to our use of Data, but we need to verify whether we have overriding legitimate grounds to use it.
                        <span></span> Request the transfer of the Data to you or to a third party. We will provide to you, or a third party you have chosen, the Data in a structured, commonly used and machine-readable format. Note that this right
                        only applies to automated information which you initially provided consent for us to use.
                        <span></span> Withdraw consent at any time where we are relying on consent to process Data. However, this will not affect the lawfulness of any processing carried out before you withdraw your consent. If you withdraw your consent,
                        we may not be able to provide the Services to you. We will advise you if this is the case at the time you withdraw your consent.
                        <span></span> You will not have to pay a fee to access Data (or to exercise any of the other rights).

                        <span></span> How to contact us? If you have any questions about how we use Data, or you wish to exercise any of the rights set out above, please contact us on our contact details mentioned in Section 3.3 of this Privacy Policy.
                    </p>
                </div>
            </div>
            <div class="policy ar" dir="rtl">
                <h2>
                    سياسة خصوصية Fakka
                </h2>
                <div class="paragraph">
                    <p>
                        <span class="title">
                            مقدمة
                        </span> يحترم Fakka خصوصيتك ويلتزم بحماية البيانات. ستُعلمك سياسة الخصوصية هذه بكيفية قيامنا بالاعتناء بالبيانات عند زيارتك واستخدامك لتطبيق الهاتف المحمول و/أو الموقع الإلكتروني الخاصين بنا (بغض النظر عن
                        المكان الذي تقوم بزيارتهم منه) وتخبرك عن حقوق الخصوصية الخاصة بك وكيف يقوم القانون بحمايتك.
                        <span class="title">
                            مسرد المصطلحات
                        </span>
                        <span class="bold">
                            أنت أو لك :
                        </span>تعود على مستخدمي التطبيق الخاص بنا.
                        <span class="bold">
                            البيانات:
                        </span>المعلومات التي يتم جمعها منك أثناء استخدام التطبيق
                        <span class="bold">
                            الخدمة:
                        </span> يقصد بها الخدمات المقدمة من خلال تطبيق دِسكونتي.
                        <span class="title"> معلومات مهمة ومن نحن

                        </span>
                        <span class="subtitle">
                            الغرض من سياسة الخصوصية هذه
                        </span> تهدف سياسة الخصوصية هذه إلى اطلاعك حول كيفية قيام Fakka بجمع البيانات ومعالجتها من خلال استخدامك لتطبيقنا، بما في ذلك أي بيانات قد تقدمها من خلال هذا التطبيق عند التسجيل و/أو استخدام خدماتنا، وكذلك
                        التثبيت والتسجيل في تطبيقنا.
                        <span></span> لا نجمع عمدًا بيانات تخص الأطفال و لكن يكن تسجيل حساب للاطفال و لكن يستطيعوا انشاء حساب خلال حسابات اولياء الأمور و تحت اشرافهم .
                        <span></span> من المهم أن تقرأ سياسة الخصوصية هذه إلى جانب الشروط والأحكام الخاصة بنا عند قيامنا بجمع أومعالجة البيانات عنك لكي تكون على دراية كاملة عن كيف ولماذا نستخدم هذه البيانات. تكمل سياسة الخصوصية هذه الإشعارات وسياسات
                        الخصوصية الأخرى ولا تهدف إلى تجاوزها.
                        <span class="subtitle">
                            المُتحكم
                        </span> شركة كينج تاج هي المتحكم والمسؤول عن البيانات (يشار إليها باسم "Fakkaا" أو "نحن" أو "إيانا" أو "لنا" في سياسة الخصوصية هذه). Fakka هي المتحكم والمسؤول عن هذا التطبيق.
                        <span></span> إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى الاتصال بنا باستخدام التفاصيل المبينة أدناه.
                        <span class="subtitle">
                            بيانات الاتصال
                        </span> إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه أو ممارسات الخصوصية الخاصة بنا، يرجى الاتصال بنا من خلال عنوان البريد الإلكتروني
                        <span></span> عنوان البريد الإلكتروني: [info@fakka.org]
                        <span class="subtitle">
                            تغييرات على سياسة الخصوصية وواجبك لإبلاغنا بالتغييرات
                        </span> نحن نخضع سياسة الخصوصية الخاصة للمراجعة الدورية. من المهم أن تكون البيانات التي نحتفظ بها عنك دقيقة وحديثة. يرجى إخطارنا إذا تغيرت البيانات خلال علاقتك معنا.
                        <span class="subtitle">
                            روابط الطرف الثالث
                        </span> قد تتضمن هذه المنصة (التطبيق) روابط إلى مواقع إلكترونية ومكونات إضافية وتطبيقات لطرف ثالث. قد يؤدي النقر على هذه الروابط أو تمكين هذه الاتصالات إلى السماح للأطراف الثالثة بجمع أو مشاركة بيانات عنك.
                        نحن لا نتحكم في التطبيقات/المواقع الإلكترونية الخاصة بهذا الطرف الثالث، ونحن غير مسؤولين عن بيانات الخصوصية الخاصة بهم. نوصيك بقراءة سياسة الخصوصية الخاصة بكل تطبيق/موقع إلكتروني تقوم بزيارته.
                        <span class="title">
                            البيانات التي نجمعها
                        </span> البيانات تعني أي معلومات عن فرد والتي يمكن منها تحديد هوية ذلك الشخص. وهي لا تشمل البيانات التي تم فيها إزالة الهوية (بيانات مجهولة المصدر).

                        <span class="subtitle">
                            نجمع ونستخدم ونخزن وننقل أنواعًا مختلفة من البيانات عنك والتي تتضمن، على سبيل المثال لا
                            الحصر، ما يلي :
                        </span> ‌أ) بيانات الهوية تشمل الاسم الأول أو اسم العائلة أو اسم المستخدم أو معرف مماثل وتاريخ الميلاد والجنس.
                        <span>
                        </span> ‌ب) بيانات الاتصال تشمل عنوان البريد الإلكتروني ورقم الهاتف المحمول

                        <span>
                        </span> ‌ج) البيانات المالية تشمل تفاصيل الحساب البنكي وتفاصيل بطاقة الدفع

                        <span>

                        </span> ‌د) البيانات الفنية تشمل بيانات تسجيل الدخول ونوع متصفح الإنترنت وإصداره وإعداد المنطقة الزمنية والموقع وأنواع المكونات الإضافية وإصدارات متصفح الإنترنت ونظام التشغيل والمنصة وغيرها من التقنيات على
                        الأجهزة التي تستخدمها للوصول إلى التطبيق/الموقع الإلكتروني.
                        <span>

                        </span> ‌ه) بيانات الملف الشخصي تشمل اسم المستخدم وكلمة المرور واهتماماتك وتفضيلاتك وقوتك الشرائية وآرائك وتقييماتك وتعليقاتك وردود الاستطلاع الخاصة بك.
                        <span>
                        </span> ‌و) بيانات الاستخدام تشمل معلومات حول كيفية استخدامك لتطبيقنا.

                        <span></span> كما نقوم أيضًا بجمع البيانات المجمعة واستخدامها ومشاركتها، مثل البيانات الإحصائية أو السكانية لأي غرض. يمكن الحصول على البيانات المجمعة من البيانات ولكنها لا تعتبر بيانات في القانون لأن هذه البيانات لن تكشف هويتك
                        بشكل مباشر أو غير مباشر. على سبيل المثال، قد نقوم بتجميع بيانات الاستخدام الخاصة بك لحساب النسبة المئوية للمستخدمين الذين يصلون إلى ميزة محددة في التطبيق. ومع ذلك، إذا قمنا بدمج أو وصل البيانات المجمعة مع البيانات بحيث يمكنها
                        تحديد هويتك بشكل مباشر أو غير مباشر، فنحن نعامل البيانات المجمعة كبيانات والتي سيتم استخدامها وفقًا لسياسة الخصوصية هذه.
                        <span></span> نحن لا نجمع أي فئات خاصة من البيانات (وهذا يشمل تفاصيل عن أصلك أو عرقك ومعتقداتك الدينية أو الفلسفية وحياتك الجنسية وتوجهك الجنسي وآرائك السياسية وعضويتك النقابية ومعلومات عن صحتك وبياناتك الجينية والأحيائية).
                        كما أننا لا نجمع أي معلومات عن القناعات الجنائية والجرائم.
                        <span></span>
                        <span class="title">
                            إذا فشلت في توفير البيانات
                        </span> عندما نحتاج إلى جمع البيانات حسب القانون، وباستخدام التطبيق الخاص بنا، وفشلت في توفير البيانات المطلوبة، قد لا نتمكن من تنفيذ خدماتنا. سنقوم بإعلامك إذا كان هذا هو الحال في ذلك الوقت.
                        <span class="title">
                            كيف يتم جمع البيانات؟
                        </span> نستخدم طرقًا مختلفة لجمع البيانات منك وعنك من خلال ما يلي:
                        <span class="subtitle">
                            التفاعلات المباشرة. يمكنك أن تمنحنا بيانات هويتك وبيانات الاتصال الخاصة بك وبياناتك المالية
                            عن طريق ملئ الاستمارات أو عن طريق التواصل معنا عن طريق الهاتف أو البريد الإلكتروني أو غير
                            ذلك. يتضمن ذلك البيانات التي تقدمها عند قيامك بما يلي:
                        </span>
                        <span>
                        </span> ‌أ) إنشاء حساب على تطبيقنا أو استخدامه؛
                        <span>
                        </span> ‌ب) دخول مسابقة اجتماعية أو عرض أو استطلاع؛ أو
                        <span></span> ‌ج) تزويدنا برأيك أو الاتصال بنا.
                        <span></span>
                        <span class="subtitle">
                            التقنيات أو التفاعلات الآلية. أثناء تفاعلك مع تطبيقنا/موقعنا الإلكتروني، سنقوم تلقائيًا بجمع
                            البيانات الفنية حول إجراءات وأنماط التصفح الخاصة بك. نجمع هذه البيانات باستخدام ملفات تعريف
                            الارتباط وسجلات الخادم وغيرها من التقنيات المماثلة.
                        </span>
                        <span class="title">
                            كيف نستخدم البيانات
                        </span>
                        <span class="subtitle">
                            سنستخدم البيانات فقط عندما يسمح لنا القانون بذلك. في الغالب، سنستخدم البيانات في الحالات
                            التالية:
                        </span> ‌أ) عندما تكون ضرورية لمصالحنا المشروعة (أو مصالح طرف ثالث) ومصالحك وحقوقك الأساسية لا تتخطى تلك المصالح.

                        <span></span> ‌ب) عندما نحتاج إلى الامتثال لالتزام قانوني.
                        <span></span> ‌ج) عندما نحتاج إلى إعداد حسابك وإدارته.
                        <span></span> ‌د) عندما نحتاج إلى إجراء استطلاعات.
                        <span></span> ‌ه) عندما نحتاج إلى تخصيص المحتوى أو تجربة المستخدم أو معلومات تجارية.
                        <span></span> و) عندما تكون قد أعطيتنا الموافقة.
                        <span></span> بشكل عام، بمجرد موافقتك علي سياسة الخصوصية الخاصة بمنصة 80 فكرةيجوز لنا معالجة البيانات و ارسالها الي طرف ثالث لاغراض تسويقية فقط و لكن لديك الحق في سحب الموافقة على امكانية التسويق في أي وقت عن طريق الاتصال بنا.

                        <span class="title">
                            الأغراض التي سنستخدم البيانات من أجلها
                        </span> أ) أداء خدماتنا:
                        <span>
                        </span> نقوم بمعالجة البيانات لأنها ضرورية لأداء خدماتنا من خلال تطبيقنا.
                        <span class="subtitle">
                            في هذا الصدد، نستخدم البيانات من أجل ما يلي:
                        </span> i. لإعداد عرض لك بخصوص الخدمات التي نقدمها؛
                        <span></span> ii. لتزويدك بالخدمات المحددة في نطاق خدماتنا، أو كما هو متفق عليه معك من وقت لآخر؛
                        <span></span> iii. للتعامل مع أي شكاوى أو أراء قد تكون لديك؛
                        <span></span> iv. لأي غرض آخر تزودنا من أجله بالبيانات التي نجمعها.
                        <span class="subtitle">
                            في هذا الصدد، يجوز لنا مشاركة البيانات أو نقلها إلى من يلي:
                        </span> i. الأطراف الثالثة المستقلة التي نتشارك معها للمساعدة في تقديم الخدمات لك؛
                        <span></span> ii. المستشارون المهنيون لدينا حيث يكون من الضروري بالنسبة لنا الحصول على مشورتهم أو مساعدتهم، ويشمل هؤلاء، المحامون أو المحاسبون أو قسم تكنولوجيا المعلومات أو مستشارو العلاقات العامة؛


                        <span></span> iii. مزودي تخزين البيانات لدينا.
                        <span></span> الأساس القانوني لتجهيز فئات البيانات المذكورة أعلاه هو قانون حماية البيانات الشخصية رقم 151 لسنة 2020 و القانون 6. (1) (أ) من اللائحة الأوروبية العامة لحماية البيانات. نظرًا للأغراض المذكورة، خصوصًا لضمان الأمان
                        وإعداد الاتصال السلس، لدينا مصلحة مشروعة في معالجة هذه البيانات.
                        <span></span> ب) المصالح المشروعة:
                        <span></span> كما نقوم أيضًا بمعالجة البيانات لأنها ضرورية لمصالحنا المشروعة، أو في بعض الأحيان عندما تكون ضرورية للمصالح المشروعة لطرف ثالث.
                        <span></span> في هذا الصدد، نستخدم البيانات لإدارة وتنظيم أعمالنا، ولأغراض التسويق أو الأرشفة أو المعالجة الإحصائية.
                        <span></span> ج) الالتزامات القانونية:
                        <span class="subtitle">
                            كما نقوم أيضًا بمعالجة البيانات من أجل امتثالنا بالتزام قانوني. في هذا الصدد، سنستخدم
                            البيانات من أجل ما يلي:
                        </span> i. لتلبية امتثالنا والتزاماتنا التنظيمية؛
                        <span></span> ii. كما هو مطلوب من قبل السلطات الضريبية أو أي محكمة مختصة أو سلطة قانونية.
                        <span></span> د) التسويق:
                        <span></span> سنرسل إليك تسويقًا حول الخدمات التي نقدمها والتي قد تهمك، بالإضافة إلى معلومات أخرى في شكل تنبيهات، أو رسائل إخبارية، أو إشعارات عن الخصومات والعروض، أو الخصائص التي نعتقد أنها قد تهمك أو من أجل تحديثك بمعلومات
                        التي نعتقد أنها قد تكون ذات صلة بك. سوف نبلغك بذلك بعدة طرق بما في ذلك عن طريق الهاتف أو الرسائل النصية القصيرة أو البريد الإلكتروني أو القنوات الرقمية الأخرى حسب الاقتضاء.

                        <span></span> ه) العروض الترويجية منا:
                        <span></span> قد نستخدم البيانات لتشكيل رؤية حول ما نعتقد أنك قد تريده أو تحتاجه أو ما قد يثير اهتمامك. هذه هي الطريقة التي نقرر بها أي التجار والمنتجات والخدمات والخصومات والعروض قد تكون ذات صلة بك.
                        <span></span> ستتلقى اتصالات تسويقية منا في حالة استخدام تطبيقنا، ولم تختر عدم تلقي هذه الاتصالات التسويقية..
                        <span></span> و) التسويق لطرف ثالث:
                        <span></span> i. نشارك البيانات مع أي طرف ثالث لأغراض التسويق.يحق للمنصة مشاركة جزء من بياناتك مع اي طرف ثالث لاغراض تسويقية و ذالك بمجرد موافقة مستخدم المنصة علي الشروط و الاحكام و سياسة الخصوصية الخاصة بالمنصة
                        <span></span> ii. يمكنك أن تطلب منا أو من الأطراف الثالثة إيقاف إرسال رسائل تسويقية إليك في أي وقت عن طريق تسجيل الدخول إلى التطبيق و التواصل مع المنصة من خلال info@fakka.org
                        <span></span> ز) ملفات تعريف الارتباط:
                        <span></span> يمكنك ضبط المتصفح الخاص بك لرفض كل أو بعض ملفات تعريف الارتباط للمتصفح، أو لتنبيهك عند قيام التطبيقات بضبط ملفات تعريف الارتباط أو السماح لها بالوصول. إذا قمت بإيقاف أو رفض ملفات تعريف الارتباط يرجى ملاحظة أنه
                        قد يتعذر الوصول لبعض أجزاء هذا التطبيق أو عدم عملها بشكل صحيح.
                        <span></span> ح) تغير الغرض:
                        <span></span> سنستخدم البيانات فقط للأغراض التي جمعناها من أجلها، ما لم نعتبر بشكل معقول أننا نحتاج إلى استخدامها لسبب آخر، وذلك السبب متوافق مع الغرض الأصلي. إذا كنت ترغب في الحصول على شرح لكيفية توافق عملية معالجة الغرض الجديد
                        مع الغرض الأصلي، يرجى الاتصال بنا على عنوان البريد الإلكتروني [info@fakka.org]. إذا احتجنا إلى استخدام البيانات لغرض غير ذي صلة، فسوف نخطرك وسنشرح الأساس القانوني الذي يسمح لنا بالقيام بذلك. يرجى ملاحظة أننا قد نقوم بمعالجة
                        البيانات دون علمك أو موافقتك، وفقًا للقواعد المذكورة أعلاه، حيث يكون هذا مطلوبًا أو مسموحًا به بموجب القانون.
                        <span></span> ط) إلغاء الاشتراك:
                        <span></span> عندما تقوم بإلغاء الاشتراك لعدم تلقي هذه الرسائل التسويقية، لن ينطبق هذا على البيانات المقدمة إلينا كنتيجة لاسترداد منتج/خدمة أو تسجيل ضمان أو تجربة منتج/خدمة في متجر أو أي معاملات أخرى ذات صلة.
                        <span class="title">
                            الإفصاح عن البيانات
                        </span> يجوز لنا مشاركة البيانات مع الأطراف المنصوص عليها في الفقرة (8) فيما يتعلق بالأغراض المحددة التي سنستخدم من أجلها البيانات المذكورة أعلاه.
                        <span></span> يجوز لنا مشاركة البيانات مع أطراف ثالثة والتي قد نختار بيع أو نقل أو دمج أجزاء من أعمالنا أو أصولنا معها. وبالتبادل، قد نسعى للحصول على أعمال أخرى أو الاندماج معها. إذا حدث تغيير في أعمالنا، فيجوز للمالكين الجدد
                        استخدام البيانات بنفس الطريقة الواردة في سياسة الخصوصية هذه.
                        <span></span> نطالب جميع الأطراف الثالثة باحترام أمن البيانات ومعالجتها وفقًا للقانون. لا نسمح لمزودي خدمات الطرف الثالث باستخدام البيانات لأغراضهم الخاصة ونسمح لهم فقط بمعالجة البيانات لأغراض محددة ووفقًا لتعليماتنا.
                        <span class="title">
                            أمن البيانات
                        </span> لقد وضعنا تدابير أمنية مناسبة لمنع فقدان البيانات أو استخدامها أو الوصول إليها بطريقة غير مصرح بها أو تغييرها أو الكشف عنها. بالإضافة إلى ذلك، نحن نحد من الوصول إلى البيانات إلى هؤلاء الموظفين والمتعاقدين
                        ومقدمي الخدمات من الأطراف الثالثة والأطراف الأخرى الذين لديهم حاجة صالحة للمعرفة. سيقومون بمعالجة البيانات فقط وفقًا لتعليماتنا ويخضعون لواجب السرية.
                        <span></span> لقد قمنا بتطبيق إجراءات للتعامل مع أي خرق للبيانات مشتبه به، وسوف نخطرك أنت وأي جهة تنظيمية معمول بها بأي خرق عند مطالبتنا قانونًا بفعل ذلك.
                        <span class="title">
                            الاحتفاظ بالبيانات
                        </span>
                        <span class="subtitle">
                            إلى متى سنستخدم البيانات؟
                        </span> سنحتفظ فقط بالبيانات طالما كانت ضرورية بشكل معقول لتحقيق الأغراض التي جمعناها من أجلها، بما في ذلك لأغراض تلبية أي متطلبات قانونية أو تنظيمية أو متطلبات الإبلاغ. يجوز لنا الاحتفاظ بالبيانات لفترة
                        أطول في حالة تقديم شكوى أو إذا كنا نعتقد بشكل معقول أن هناك احتمالًا للتقاضي فيما يتعلق بعلاقتنا بك.
                        <span></span> لتحديد الفترة المناسبة للاحتفاظ بالبيانات، فإننا نأخذ في الاعتبار مقدار وطبيعة وحساسية البيانات، والمخاطر المحتملة للضرر من الاستخدام غير المصرح به أو الكشف عن البيانات، والأغراض التي نعالج من أجلها البيانات وما
                        إذا كان بإمكاننا تحقيق تلك الأغراض من خلال وسائل أخرى والمتطلبات القانونية أو التنظيمية أو غيرها من المتطلبات المعمول بها.
                        <span></span> عندما لم يعد من الضروري الاحتفاظ بالبيانات، سنقوم بحذفها.
                        <span class="tile">
                            ما قد نحتاجه منك
                        </span> قد نحتاج إلى طلب معلومات محددة منك لمساعدتنا في تأكيد هويتك وضمان حقك في الوصول إلى البيانات (أو ممارسة أيًا من حقوقك الأخرى). يعتبر هذا الإجراء أمنيًا لضمان عدم الكشف عن البيانات لأي شخص ليس لديه
                        الحق في استلامها. قد نتصل بك أيضًا لطلب المزيد من المعلومات لتحسين خدماتنا.
                        <span class="title">
                            كيف نتعامل مع "حق المرء أن يُنسى"؟
                        </span> لديك الحق في طلب محو البيانات التي نحتفظ بها عنك في ظروف معينة، على سبيل المثال إذا لم يتم الحصول عليها لغرض قانوني أو لم تعد ضرورية لهذا الغرض القانوني. هذا معروف باسم حق المرء أن يُنسى. عندما تطلب
                        منا مسح بياناتك، فإننا عادةً ما نفعل ذلك فقط حيث لم تعد البيانات متاحة علنًا أو حيث لم نعد نستخدمها بعد.
                        <span class="title">
                            الأساس القانوني
                        </span> المصالح المشروعة تعني اهتمام أعمالنا في مباشرة أعمالنا وإدارتها لتمكيننا من أن نقدم لك أفضل الخدمات وأفضل التجارب وأكثرها أمانًا. نحن نتأكد من أننا نأخذ بعين الاعتبار أي تأثير محتمل عليك وعلى حقوقك
                        وأن نوازنه (سواء كان إيجابيًا أو سلبيًا) قبل أن نقوم بمعالجة البيانات أو من أجل مصالحنا المشروعة. نحن لا نستخدم البيانات للأنشطة حيث يتم تجاوز اهتماماتنا من خلال التأثير عليك (ما لم نحصل على موافقتك أو إذا كان ذلك مطلوبًا أو
                        مسموحًا به بموجب القانون). يمكنك الحصول على مزيد من المعلومات حول كيفية تقييمنا لمصالحنا القانونية ضد أي تأثير محتمل عليك فيما يتعلق بأنشطة معينة عن طريق الاتصال بنا.
                        <span></span> إن الامتثال لالتزام قانوني يعني معالجة البيانات عندما يكون ذلك ضروريًا للامتثال لالتزام قانوني نتعرض له.
                        <span class="title">
                            الأطراف الثالثة
                        </span> الأطراف الثالثة الخارجية
                        <span></span> مقدمي الخدمات الذين يقدموا الخدمات في تطبيقنا.
                        <span></span> المستشارون المهنيون الذين يعملون كمعالجين أو مراقبين مشتركين ويشمل هؤلاء، المحامون والمصرفيون ومدققو الحسابات حسب مقتضى الحال، الذين يقدمون الخدمات الاستشارية والخدمات المصرفية والقانونية والمحاسبية.
                        <span class="title">
                            حقوقك القانونية
                        </span>
                        <span class="subtitle">
                            لديك الحق في:
                        </span> الوصول إلى البيانات على تطبيقنا. يتيح لك هذا الحصول على نسخة من البيانات التي نحتفظ بها عنك والتحقق من أننا نقوم بمعالجتها بشكل قانوني.
                        <span></span> طلب تصحيح البيانات التي نحتفظ بها عنك. يمكّنك هذا من الحصول على أي بيانات غير كاملة أو غير دقيقة نحتفظ بها عنك، على الرغم من أننا قد نحتاج إلى التحقق من دقة البيانات الجديدة التي تقدمها لنا.
                        <span></span> طلب محو البيانات الشخصية. يمكّنك هذا من مطالبتنا بحذف أو إزالة البيانات عندما لا يوجد سبب وجيه لنا لمواصلة معالجتها. لديك أيضًا الحق في مطالبتنا بحذف أو إزالة البيانات التي مارست فيها حقك في الاعتراض على المعالجة
                        بنجاح (انظر أدناه)، حيث ربما قمنا بمعالجة معلوماتك بشكل غير قانوني أو حيث يُطلب منا مسح البيانات للامتثال للقانون المحلي.
                        <span></span> الاعتراض على معالجة البيانات حيث نعتمد على مصلحة مشروعة (أو تلك الخاصة بطرف ثالث) وهناك شيء يتعلق بوضعك الخاص مما يجعلك ترغب في الاعتراض على المعالجة على هذا الأساس حيث تشعر أنها تؤثر على حقوقك الأساسية وحرياتك.
                        لديك أيضًا الحق في الاعتراض حيث نقوم بمعالجة البيانات لأغراض التسويق المباشر. في بعض الحالات، قد نثبت أن لدينا أسبابًا مشروعة مقنعة لمعالجة معلوماتك والتي تتجاوز حقوقك وحرياتك.

                        <span class="subtitle">
                            طلب تقييد معالجة البيانات. يتيح لك هذا أن تطلب منا تعليق معالجة البيانات في الحالات التالية:
                        </span> • إذا كنت تريد منا تحديد دقة البيانات.
                        <span></span> • حيث يكون استخدامنا للبيانات غير قانوني، لكنك لا تريد منا أن نمسحها.
                        <span></span> • حيث تريدنا أن نحتفظ بالبيانات حتى إذا لم نعد نطلبها لاحتياجك إليها لتأسيس دعاوى قانونية أو ممارستها أو الدفاع عنها.
                        <span></span> • اعتراضك على استخدامنا للبيانات، ولكننا نحتاج إلى التحقق مما إذا كان لدينا أسباب مشروعة لاستخدامها.
                        <span></span> اطلب نقل البيانات إليك أو إلى طرف ثالث. سنقدم لك، أو لطرف ثالث اخترته، البيانات بتنسيق منظم شائع الاستخدام ومقروء آليًا. لاحظ أن هذا الحق ينطبق فقط على المعلومات المؤتمتة التي منحتنا موافقتك في البداية لاستخدامها.
                        <span></span> سحب الموافقة في أي وقت حيث أننا نعتمد على الموافقة لمعالجة البيانات. ومع ذلك، لن يؤثر ذلك على قانونية أي معالجة تتم قبل سحب موافقتك. إذا سحبت موافقتك، فقد لا نتمكن من تقديم الخدمات لك. سننصحك إذا كانت هذه هي الحالة
                        في الوقت الذي تسحب فيه موافقتك.
                        <span></span> لن تضطر إلى دفع رسوم للوصول إلى البيانات (أو ممارسة أي من الحقوق الأخرى).
                        <span></span> كيف تتواصل معنا؟ إذا كان لديك أي أسئلة حول كيفية استخدامنا للبيانات، أو كنت ترغب في ممارسة أي من الحقوق المذكورة أعلاه، يرجى الاتصال بنا على تفاصيل الاتصال الخاصة بنا المذكورة في القسم 3.3 من سياسة الخصوصية هذه.
                    </p>

                </div>
            </div>
        </div>
    </div>




    <div class="contact">
        <div class="container">
            <div class="title">
                <h2>
                    We will be happy
                </h2>
            </div>
            <p>
                To answer all your questions
            </p>
            <a href="{{ route('fakka.contactus.index') }}">
                Contact us
            </a>
        </div>
    </div>
</main>

@endsection