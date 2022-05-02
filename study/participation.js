define(['questAPI'], function(Quest){
    var API  = new Quest();
    var uuid = Math.random();

    API.addQuestionsSet({
      email: [{
        name: 'email',
        type: 'text',
        numericValues: true,
        stem: 'Please enter your email address:',
        pattern: /[A-Z0-9\._%+-]+@[A-Z0-9\.-]{2,}\.[A-Z]{2,}/igm,
        errorMsg: {
            required: "If you’ve indicated that you’d like us to recontact you, you must enter your email address.",
            pattern: "This is not a valid email address.",
        },
        required: true,
      }],
      first_name: [{
        name: 'first_name',
        type: 'text',
        stem: 'Please enter your first name:',
        errorMsg: {
            required: "If you’ve indicated that you’d like us to recontact you, you must enter your entire name.",
        },
        required: true,
      }],

      last_name: [{
        name: 'last_name',
        type: 'text',
        // numericValues: true,
        stem: 'Please enter your last name:',
        errorMsg: {
            required: "If you’ve indicated that you’d like us to recontact you, you must enter your entire name.",
        },
        required: true,
        onCreate: function(log, current) {
          current.questions.uuid = new Object();
          current.questions.uuid.name = 'uuid';
          current.questions.uuid.response = Math.random();
        },
      }],
      uuid: [{
        name: 'uuid',
        dflt: uuid,
      }],
      participate: [{
        name: 'participate',
        type: 'selectOne',
        numericValues: true,
        stem: '<h5>Participation</h5>I have read the above information, have been provided with the opportunity to have any question about this study answered, and:',
        autoSubmit: false,
        answers: [{text: 'I agree to participate', value: 1},
                  {text: 'I decline to participate', value: 2},
                 ],
        required: true,
        onCreate: function(log, current) {
          current.questions.uuid = new Object();
          current.questions.uuid.name = 'uuid';
          current.questions.uuid.response = Math.random();
        },
      }],
      recontact: [{
        name:    'recontact',
        type:    'selectMulti',
        numericValues: true,
        stem:    '<h5>Re-contact</h5>We would like to ask your permission to contact you again in the future. This contact would be after the study has ended. Please select your choices below:',
        autoSubmit: true,
        answers: [
                  'You may contact me again to ask for additional information related to this study.',
                  'You may contact me again to let me know about a different research study.',
                 ],
        required: false,
      }],
      uuid: [{
        name: 'uuid',
        dflt: uuid,
      }],
    });

    API.addSequence([{ // page begins
            // lognow: true, // log this page when it's left
        header: '<!-- See participation.html in the text assets directory for editable version --><div class="panel panel-info">  <div class="panel-body">    <img src="./study/media/P-I_logo.png" class="p-i-logo"/>    <h1>Clinical Decision-Making in the Prenatal Setting</h1>    <h2>Research consent form</h2>    <h5>Basic Information</h5>    <ul>      <li>Title of Project: Project Inclusive Genetics</li>      <li>IRB Number: H-38446</li>      <li>Sponsor: Association of American Medical Colleges</li>      <li>Principal Investigator:      <ul class="address">        <li>Shoumita Dasgupta</li>        <li><a href="mailto:dasgupta@bu.edu">dasgupta@bu.edu</a></li>        <li>72 East Concord Street, E-200</li>        <li>Boston, MA 02118</li>      </ul>      <li>Study Phone Number: 617-358-7288</li>    </ul>    <h5>Overview/Purpose</h5>    <p>We are asking you to be in a research study. We are doing the research to examine the clinical decision-making practices of providers and trainees in the prenatal setting. If you agree, you will complete a pre- and post-survey and may review an educational module on the principles of patient-centered counseling and shared decision-making. </p>    <h5>What Will Happen in This Research Study</h5>    <p>The study will include hypothetical prenatal cases with multiple response choices, a survey of background information, and a potential educational module involving elements of social psychology and principles of patient-centered counseling. All of these elements will be accessed on-line, and it is anticipated that the full series of activities will take 30 minutes to complete.</p>    <h5>Risks and Benefits</h5>    <p>There are no perceived physical risks or anticipated adverse effects resulting from your participation in this study. </p>    <p>There is no direct benefit to you from participation. Your being in the study may help the investigators learn about clinical decision-making practices.</p>    <h5>Costs and Payment</h5>      <p>There are no costs to you for being in this research study. </p>      <p>You will not be paid for being in this study. <!-- However, upon completion of the series of activities, you will be eligible to claim 0.5 CME/CEU credits, if you should so desire.--></p>    <h5>Confidentiality</h5>    <p><!--We must use information that shows your identity only for the purpose of providing CME/CEU credits, if you choose to receive them. The rest of the information that you provide in this study will be handled anonymously. -->Any information that is personally identifiable will not be included for response analysis.</p>    <h5>Subject’s Rights</h5>    <p>By consenting to be in this study you do not waive any of your legal rights. Consenting means that you have been given information about this study and that you agree to participate in the study. Please save this form or contact the study team if you would like a copy of this form to keep.</p>    <p>If you do not agree to be in this study or if at any time you withdraw from this study you will not suffer any penalty or lose any benefits to which you are entitled. Your participation is completely up to you. Your decision will not affect your ability to get health care or payment for your health care. It will not affect your enrollment in any health plan or benefits you can get.</p>    <h5>Questions</h5>    <p>The investigator or a member of the research team will try to answer all of your questions. If you have questions or concerns at any time, contact Apolline Jungels at <a href="mailto:ajungels@bu.edu">ajungels@bu.edu</a>.</p>    <p>You may also call 617-358-5372 or email <a href="mailto:medirb@bu.edu">medirb@bu.edu</a>. You will be talking to someone at the Boston Medical Center and Boston University Medical Campus IRB. The IRB is a group that helps monitor research. You should call or email the IRB if you want to find out about your rights as a research subject. You should also call or email if you want to talk to someone who is not part of the study about your questions, concerns, or problems.</p>    <p>By agreeing to be in this research and clicking Yes to participate, you are indicating that you have read this form, that your questions have been answered to your satisfaction, and that you voluntarily agree to participate in this research study.</p>    <h4 class="disclaimer">This module requires a keyboard to complete. Please use a computer with a keyboard.</h4>    <p>If you have trouble completing the module, in rare cases some institutions have policies that restrict code used for testing; please try again outside an institutional setting.</p>  </div></div>',
        questions: [{inherit: 'recontact'},
                    {inherit: 'participate'},
                    {
                      remix: true, // remix:true is neccessary so that the mixer is re-evaluated each time that the responses change
                      mixer: 'branch',
                      conditions: [{
                        or: [
                             {compare: 1, to: 'current.questions.recontact.response', operator: 'in'},
                             {compare: 2, to: 'current.questions.recontact.response', operator: 'in'},
                            ],
                        }],
                      data: [
                        {inherit: 'first_name'},
                        {inherit: 'last_name'},
                        {inherit: 'email'},
                      ],
                    },
                   ], // end of questions
    }]); // end of page
    return API.script;
});
