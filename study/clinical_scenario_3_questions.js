define(['questAPI'], function(Quest){
    var API = new Quest();

    API.addSequence([
        { // page begins
            header: '<p style="font-weight: 400; font-size: 15px; color: black; line-height: 1.4em; width: 75%;">A couple, Mr. and Mrs. H, was referred to you for a prenatal counseling session at 12 weeks gestation because they were both found to be carriers of ataxia telangiectasia (AT) through expanded carrier screening ordered by Mrs. H’s obstetrician. AT is a condition characterized by childhood onset movement problems called ataxia. They can have difficulty walking and with balance, chorea, and neuropathy. The movement problems typically cause people to require wheelchair assistance by adolescence. They can also have a weakened immune system and an increased risk for cancer. The phenotype typically presents only with physical aspects to the condition. The lifespan varies greatly, but individuals typically survive into early adulthood. When both parents are carriers, each pregnancy has a 25% risk to be affected.</p> Select an answer from the choices below',
            questions: [
                { // question 1 begins
                    name: 'AT terminate',
                    type: 'selectOne',
                    stem: 'The couple tells you they would terminate the pregnancy if the fetus was found to have AT. If you were the patient’s healthcare provider, how would you counsel the couple about testing?',
                    autoSubmit: false,
                    answers: [
                               'Strongly recommend prenatal testing',
                               'Recommend prenatal testing',
                               'Offer but neither recommend nor discourage prenatal testing',
                               'Discourage prenatal testing',
                               'Strongly discourage prenatal testing',
                    ],
                    required: true,
                    correct:  false,
                    // numericValues: true,
                },
                { // question 2 begins
                    name: 'AT not terminate',
                    type: 'selectOne',
                    stem: 'The parents tells you they would NOT terminate the pregnancy, regardless of the results. If you were the patient’s healthcare provider, how would you counsel the couple about testing?',
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
                    name: 'AT personal testing',
                    type: 'selectOne',
                    stem: 'If you were personally the patient, would you get prenatal genetic testing for AT?',
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
                    name: 'AT personal terminate',
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
                    name: 'AT influence',
                    type: 'selectOne',
                    stem: 'The impact AT has on physical abilities has had the following influence on my above decisions:',
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
