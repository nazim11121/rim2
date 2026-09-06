<?php

/* ⚠ THE POLICY BELOW IS A PLACEHOLDER AND MUST BE CONFIRMED BY THE RESORT.
   It is written as a sane default so the code is complete, not because anyone
   has approved these numbers. Publish the real tiers on the site before taking
   a single live reservation: a refund rule a guest has not seen is a rule you
   cannot enforce. */
return [
    'cancellation_tiers' => [
        ['days' => 7, 'refund' => 1.0],
        ['days' => 3, 'refund' => 0.5],
        ['days' => 0, 'refund' => 0.0],
    ],
];
