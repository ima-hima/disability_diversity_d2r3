import csv
import numpy as np
import unittest
import os
import scipy.stats

from csv import DictWriter


### TODO: add check for multiple attempts. Remove least recent?

def select_multiple(line):
    """Return section, which question, values for arrays of values."""
    idx = line.find('[')
    if idx > -1:
        end_idx = line.find(']')
        value = line[idx+1:end_idx]
    else:
        value = ''
    line = line.split(',')

    return line[0], line[3], value


def pretty_print_dictionary(input_dict):
    for master_key in sorted(list(input_dict.keys())):
        print(master_key)
        for subkey in sorted(list(input_dict[master_key].keys())):
            print ('\t' + '(' + subkey + '), ' + input_dict[master_key][subkey], sep=': ')


pd_feedback_sextiles = {
    'There were not enough trials to determine a result.': '0',
    'There were too many fast trials to determine a result.': '0',
    'Your data suggest a strong automatic preference for Physically disabled over Abled persons.': '1',
    'Your data suggest a moderate automatic preference for Physically disabled over Abled persons.': '2',
    'Your data suggest a weak automatic preference for Physically disabled over Abled persons.': '3',
    'Your data suggest a slight automatic preference for Physically disabled over Abled persons.': '4',
    'Your data suggest no automatic preference between Abled persons and Physically disabled.': '5',
    'Your data suggest a slight automatic preference for Abled persons over Physically disabled.': '6',
    'Your data suggest a weak automatic preference for Abled persons over Physically disabled.': '7',
    'Your data suggest a moderate automatic preference for Abled persons over Physically disabled.': '8',
    'Your data suggest a strong automatic preference for Abled persons over Physically disabled.': '9',
    }

id_feedback_sextiles = {
    'There were not enough trials to determine a result.': '0',
    'There were too many fast trials to determine a result.': '0',
    'Your data suggest a strong positive automatic attitude toward Intellectually disabled.': '1',
    'Your data suggest a moderate positive automatic attitude toward Intellectually disabled.': '2',
    'Your data suggest a weak positive automatic attitude toward Intellectually disabled.': '3',
    'Your data suggest a slight positive automatic attitude toward Intellectually disabled.': '4',
    'Your data suggest a neutral automatic attitude toward Intellectually disabled.': '5',
    'Your data suggest a slight negative automatic attitude toward Intellectually disabled.': '6',
    'Your data suggest a weak negative automatic attitude toward Intellectually disabled.': '7',
    'Your data suggest a moderate negative automatic attitude toward Intellectually disabled.': '8',
    'Your data suggest a strong negative automatic attitude toward Intellectually disabled.': '9',
    }

clinical_scenarios_values = {
    # There are several bugs in the collection script. They're marked here.
    'Strongly recommend prenatal testing': '1',
    '1': '1', # bug
    'Recommend prenatal testing': '2',
    '2': '2',
    'Offer but neither recommend nor discourage prenatal testing': '3',
    'Offer but neither recommend or discourage prenatal testing': '3', # bug
    '3': '3', # bug
    'Discourage prenatal testing': '4',
    '4': '4',
    'Strongly discourage prenatal testing': '5',
    '5': '5',
    'Yes': '1',
    'Most likely': '2',
    'Unsure': '3',
    'Probably not': '4',
    'No': '5',
    'Great influence': '1',
    'Moderate influence': '2',
    'Neutral': '3',
    'Little influence': '4',
    'No influence': '5',
    }


def collect_data():
    """Collect data from both answers and feedback files. Ignore identifying information until it's
    for CE credit."""
    values = {}
    cur_dir = ''
    # First set up dictionary using uuid as key and (section, which question) as secondary key.
    for this_dir, sub_dirs, files in os.walk(os.getcwd()):
        if this_dir.split('/')[-1] == 'answers':
            for file in [f for f in files if not f == ".htaccess"]:

                # Uuid is l. 418.
                # Demographics are ll. 431–451 in answers.
                with open(os.path.join(this_dir, file)) as file_handle:
                    line = file_handle.readline()
                    while line[16:20] != 'uuid':
                        line = file_handle.readline()
                    # Unluckily I have to do this bacause uuid comes later.
                    uuid = line.split(',')[9] # uuid line
                    if uuid not in values:
                        values[uuid] = {}
                    # Ignore rest of participation section, which is identifying info. We'll collect
                    # this later if we need to.
                    line = file_handle.readline()
                    while line.startswith('part'): #[:4] == 'part':
                        line = file_handle.readline()
                    # values[uuid][(section, answer)] = real_value
                    # line = file_handle.readline()
                    for line in file_handle.readlines() + [line]: # have to add the line we've already read.
                        # is answer a list? I shouldn't have to worry about brackets before ninth entry
                        if not line.startswith('ce_')
                           and not line.startswith('cont')
                           and not line.startswith('ceu_'):
                                   # line[:3] != 'ce_' and line[:4] != 'cont' and line[:4] != 'ceu_':
                            # if line.startwith('demo']: #[:4] == 'demo':
                            #     print(line)
                            if line.find('[') > -1:
                                (section, answer, real_value) = select_multiple(line)
                                # print(real_value)
                                values[uuid][section + ': ' + answer] = real_value
                            else:
                                line = line.split(',')
                                if line[0].startswith('clin'): #[:4] == 'clin':
                                    # if line[9][0] == 'N':
                                    #     print(file, line)
                                    values[uuid][line[0] + ': ' + line[3]] = clinical_scenarios_values[line[9]]
                                else:
                                    values[uuid][line[0] + ': ' + line[3]] = line[9]

        if this_dir.split('/')[-1] == 'feedback':
            pd_counts = {}
            id_counts = {}

            for file in [f for f in files if not f == ".htaccess"]:
                file_handle = open(os.path.join(this_dir, file))
                contents = file_handle.readlines()
                # contents[1] is uuid
                # contents[2] is PD
                # contents[3] is ID
                # feedback[contents[1]].append(pd_feedback_sextiles[contents[2]])
                # pd_counts[contents[2]] = pd_counts.get(contents[2], 0) + 1
                # id_counts[contents[3]] = id_counts.get(contents[3], 0) + 1
                uuid = contents[1][:-1]
                if uuid not in values:
                    values[uuid] = {}
                values[uuid]['iat' + ': ' + 'pd'] = pd_feedback_sextiles[contents[2][:-1]]
                values[uuid]['iat' + ': ' + 'id'] = id_feedback_sextiles[contents[3][:-1]]
    # pretty_print_dictionary(values)
    print_to_csv(os.getcwd(), values)


def print_to_csv(this_dir, values):
    with open(os.path.join(this_dir, 'output.csv'), 'w', newline='') as csv_file:
        # out_csv = File(f)
        key = list(values.keys())[0]
        headers = [m for m in values[key]]
        print(headers)
        writer = DictWriter(csv_file, fieldnames=headers)
        row = {m: m for m in headers}
        # row = { m[0]: m[1] for m in get_specimen_metadata(request) }
        # key = list(values.keys())[0]
        writer.writerow(row)
        for row in list(values.keys()):
            print(values[row])
            writer.writerow(values[row])


collect_data()

