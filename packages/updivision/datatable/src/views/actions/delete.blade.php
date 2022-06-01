<a
    href="javascript:void();"
    onclick="if(!confirm('Are you sure?')) { event.preventDefault(); }"
    wire:click="delete({{ $entity->{$primaryKey} }})"
    {{ $action->renderAttributes() }}
>
    {{ $action->text }}
</a>