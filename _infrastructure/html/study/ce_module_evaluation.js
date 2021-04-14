define(['questAPI'], function(Quest){
    var API = new Quest();

    API.addSequence([
    { // Self assessment
      header: 'Self-Assessment: <p style="font-weight: 400; font-size: 18px; color: black; line-height: 0; margin-top: 1.4em; width: 75%;">I achieved the following learning objectives from this program/session:</p>',
      questions: [
        {
            name: 'ceu_can_measure_implicit_bias',
            type: 'selectOne',
            stem: 'Measure possible implicit bias against physical and intellectual disabilities to bring awareness to possibly unrecognized implicit bias.',
            autoSubmit: false,
            answers: [
                       'Strongly disagree',
                       'Disagree',
                       'Agree',
                       'Strongly agree',
            ],
            required: true,
        },
        {
            name: 'ceu_can_describe_p-c_module',
            type: 'selectOne',
            stem: 'Describe a patient-centered model for genetic counseling.',
            autoSubmit: false,
            answers: [
                       'Strongly disagree',
                       'Disagree',
                       'Agree',
                       'Strongly agree',
            ],
            required: true,
        },
        {
            name: 'ceu_can_outline_decision_making',
            type: 'selectOne',
            stem: 'Outline how to facilitate autonomous decision making.',
            autoSubmit: false,
            answers: [
                       'Strongly disagree',
                       'Disagree',
                       'Agree',
                       'Strongly agree',
            ],
            required: true,
        },
        {
            name: 'ceu_can_apply_knowledge',
            type: 'selectOne',
            stem: 'Apply knowledge of patient-centered genetic counseling techniques to clinical case scenarios.',
            autoSubmit: false,
            answers: [
                       'Strongly disagree',
                       'Disagree',
                       'Agree',
                       'Strongly agree',
            ],
            required: true,
          },
        ],
      },   // end self-assessment
      {    // begin learning assessment
        header: 'Learning assessment',
        questions: [
          {
              name: 'ceu_learning_assessment',
              type: 'selectOne',
              stem: 'How much did you learn as a result of this program/session?',
              autoSubmit: false,
              answers: [
                         'Very little',
                         'Little',
                         'A good bit',
                         'A great deal',
              ],
              required: true,
          },
        ],
      },    // end learning assessment
      {     // begin module evaluation
        header: 'Teaching module assessment',
        questions: [
          {
              name: 'ceu_level-appropriate_content',
              type: 'selectOne',
              stem: 'The content was appropriate for post-graduate level training/instruction.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_level-appropriate_instruction',
              type: 'selectOne',
              stem: 'The instruction was at a level appropriate to post-graduate level training/instruction.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_relevant_content',
              type: 'selectOne',
              stem: 'The content was relevant to genetic counseling practice (i.e. reflects practice-based competencies and/or practice analysis).',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_consistent_content',
              type: 'selectOne',
              stem: 'The content was consistent with the genetic counseling Code of Ethics.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_effective_teaching_methods',
              type: 'selectOne',
              stem: 'The teaching methods were effective.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_teaching_aids_clarified_content',
              type: 'selectOne',
              stem: 'Visual aids, handouts, and oral presentations clarified content.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_knew_subject_matter',
              type: 'selectOne',
              stem: 'The course designers knew the subject matter.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_effectively_presented',
              type: 'selectOne',
              stem: 'The course presented content effectively.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_elaborated_objectives',
              type: 'selectOne',
              stem: 'The course elaborated on stated objectives.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_maintained_interest',
              type: 'selectOne',
              stem: 'The course maintained my interest.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_commercially_unbiased',
              type: 'selectOne',
              stem: 'The course presented content without any bias of any commercial product.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
          {
              name: 'ceu_disclosed_conflicts',
              type: 'selectOne',
              stem: 'The course designers disclosed any conflict of interest or lack of a conflict of interest at the start of the session.',
              autoSubmit: false,
              answers: [
                         'Strongly disagree',
                         'Disagree',
                         'Agree',
                         'Strongly agree',
              ],
              required: true,
          },
        ],
      },  // end module evaluation
    ]);   // end sequence
  return API.script;
});
