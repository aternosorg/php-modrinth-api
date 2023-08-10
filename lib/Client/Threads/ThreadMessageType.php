<?php

namespace Aternos\ModrinthApi\Client\Threads;

enum ThreadMessageType: string
{
    case STATUS_CHANGE = "status_change";
    case TEXT = "text";
    case THREAD_CLOSURE = "thread_closure";
    case DELETED = "deleted";
}