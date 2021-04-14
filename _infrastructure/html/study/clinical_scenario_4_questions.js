define(['questAPI'], function(Quest){
    var API = new Quest();

    API.addSequence([
        { // page begins
            header: '<p style="font-weight: 400; font-size: 15px; color: black; line-height: 1.4em; width: 75%;">A 38-year-old female, Ms. F, is referred to you at 18 weeks gestation because she had a prenatal blood test that evaluates DNA from the pregnancy in maternal blood (cell-free DNA screening), and the test has come back indicating the pregnancy has an increased risk to be affected with Down syndrome. Down syndrome is characterized by a wide range of developmental and physical disabilities, including mild to moderate intellectual disabilities, developmental delay, characteristic facial features, congenital heart defects and other congenital anomalies, and an increased risk for several health concerns, most of which are treatable. You counsel the patient that while the blood test results show an increased chance that the fetus has Down Syndrome (approximately 90% chance), it is not definitive, and an amniocentesis is necessary to rule out or diagnose the condition.</p>Select an answer from the choices below',
            questions: [
                { // question 1 begins
                    name: 'Down terminate',
                    type: 'selectOne',
                    stem: 'The couple tells you they would terminate the pregnancy if the fetus was found to have Down Syndrome. If you were the patient’s healthcare provider, how would you counsel the couple about testing?',
                    autoSubmit: false,
                    answers: [
                               'Strongly recommend prenatal testing',
                               'Recommend prenatal testing',
                               'Offer but neither recommend nor discourage prenatal testing',
                               'Discourage prenatal testing',
                               'Strongly discourage prenatal testing',
                    ],
                    required: true,
                },
                { // question 2 begins
                    name: 'Down not terminate',
                    type: 'selectOne',
                    stem: 'The parents tell you they would NOT terminate the pregnancy, regardless of the results. If you were the patient’s healthcare provider, how would you counsel the couple about testing?',
                    autoSubmit: false,
                    answers: [
                               'Strongly recommend prenatal testing',
                               'Recommend prenatal testing',
                               'Offer but neither recommend nor discourage prenatal testing',
                               'Discourage prenatal testing',
                               'Strongly discourage prenatal testing',
                    ],
                    required: true,
                },
                { // question 3 begins
                    name: 'Down personal testing',
                    type: 'selectOne',
                    stem: 'If you were personally the patient, would you get prenatal genetic testing for DS?',
                    autoSubmit: false,
                    answers: [
                               'Yes',
                               'Most likely',
                               'Unsure',
                               'Probably not',
                               'No',
                    ],
                    required: true,
                },
                { // question 4 begins
                    name: 'Down personal terminate',
                    type: 'selectOne',
                    stem: 'If you were personally the patient, would you seek to terminate the pregnancy based on the results?',
                    autoSubmit: false,
                    answers: [
                               'Yes',
                               'Most likely',
                               'Unsure',
                               'Probably not',
                               'No',
                    ],
                    required: true,
                },
                { // question 5 begins
                    name: 'Down influence',
                    type: 'selectOne',
                    stem: 'The impact Downs Syndrome has on intellectual abilities has had the following influence on my above decisions:',
                    autoSubmit: false,
                    answers: [
                               'Great influence',
                               'Moderate influence',
                               'Neutral',
                               'Little influence',
                               'No influence',
                    ],
                    required: true,
                },
            ]
        } // page ends
    ]);

    return API.script;
});
