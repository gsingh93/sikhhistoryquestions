#!/usr/bin/env python2

"""
Parses a text file of questions and outputs a JSON file in the format listed below.

The format of the text file is

1.<WHITESPACE>Question text
<WHITESPACE>Question answer (multiple lines is fine)

JSON Format:

[
  {
    "answer": "Answer here",
    "question": "Question here"
  },
  ...
]
"""

import json
import re
import sys


QUESTION_RE = re.compile('\d+\.\s(.*)')
questions = []


def add_question(question, answer):
    global questions

    q = {}
    q['question'] = question
    q['answer'] = answer.strip()
    questions.append(q)


def main():
    if len(sys.argv) < 3:
        print 'Usage: %s input_file output_file' % sys.argv[0]
        exit(1)

    with open(sys.argv[1]) as f:
        question = ''
        answer = ''
        for l in f.read().split('\n'):
            m = QUESTION_RE.match(l)
            if m is not None:
                if answer != '':
                    add_question(question, answer)
                    answer = ''

                question = m.group(1).strip()
            else:
                l = l.strip()
                if l != '':
                    answer += l + '\n'

        # Add the last answer
        add_question(question, answer)

    with open(sys.argv[2], 'w+') as f:
        json.dump(questions, f)


if __name__ == '__main__':
    main()
