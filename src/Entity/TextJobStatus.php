<?php

namespace App\Entity;

enum TextJobStatus: string
{
    case INITIAL = "INITIAL";
    case FAILED = "FAILED";
    case CANCELLED = "CANCELLED";
    case COMPLETED = "COMPLETED";
    case INPROGRESS = "INPROGRESS";
}