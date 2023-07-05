    @if($chat->company_id != null)
        <button type="button" class="btn btn-btn btn-success btn-sm " data-toggle="modal" data-target="#replay{{ $chat->id }}">
            {{ __('chats.replay') }}
        </button>
    @endif
    <form style="display: inline-block;" action="{{ route('admin.chats.replay', $chat->id) }}"  enctype="multipart/form-data"
        class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
        @csrf
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="replay{{ $chat->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('chats.replay') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="hidden" value="{{ $chat->id }}" name="chat_id">
                                <input type="hidden" value="{{ $chat->company_id }}" name="company_id">
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput1">{{ __('chats.message') }}</label>
                                        <textarea class="form-control tinymce" name="message"
                                                   id="" cols="30" rows="10">
                                                    {!! old('messag')  !!}
                                        </textarea>
                                    </div>
                                    @error('message')
                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('site.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('site.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
{{--  --}}

<button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $chat->id }}">
    <i class="fa fa-trash"></i>
    {{ __('site.delete') }}
</button>
<form action="{{ route('admin.chats.destroy', $chat->id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
    @csrf
    @method('delete')

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="delete{{ $chat->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('site.delete') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input type="hidden" value="{{ $chat->id }}">
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('site.warning') }}</h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('site.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
