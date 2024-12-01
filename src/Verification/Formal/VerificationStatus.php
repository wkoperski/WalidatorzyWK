<?php

namespace Verification\Formal;

enum VerificationStatus: string
{
    case ALL = '*';
    case REJECTED = "ODRZUCONA";
    case IN_ACCEPTANCE = "W AKCEPTACJI";

}