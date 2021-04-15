define(['questAPI'], function(Quest){
    var API = new Quest();

    API.addSequence([
        { // page begins
            header: '<p style="font-weight: 400; font-size: 15px; color: black; line-height: 1.4em; width: 75%;">A 30-year-old woman, Ms. N, comes to you because she recently learned she is a premutation carrier of Fragile X syndrome and is pregnant with a male fetus. Fragile X syndrome is an X-linked condition characterized by cognitive impairment, developmental delays, and autism. She understands that she has a 50% risk to have a baby with Fragile X syndrome and is interested in learning more about her testing options.</p>Select an answer from the choices below',
            questions: [
                { // question 1 begins
                    name: 'question1',
                    type: 'selectOne',
                    stem: 'The parents tell you they would terminate the pregnancy, if the fetus were found to have Fragile X syndrome. If you were the patient’s healthcare provider, how would you counsel the couple about testing?',
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
                    name: 'question2',
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
                    name: 'question3',
                    type: 'selectOne',
                    stem: 'If you were personally the patient, would you get prenatal genetic testing for Fragile X syndrome?',
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
                    name: 'question4',
                    type: 'selectOne',
                    stem: 'If you were personally the patient, would you seek to terminate the pregnancy if the results indicate the fetus has Fragile X syndrome?',
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
                    name: 'question5',
                    type: 'selectOne',
                    stem: 'The impact Fragile X syndrome has on intellectual abilities has had the following influence on my above decisions:',
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
