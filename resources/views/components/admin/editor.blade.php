@props([
    'name' => 'description',
    'label' => 'Description',
    'value' => '',
    'height' => '500px',
])

<label class="form-label">{{ $label }}</label>
<div id="editor-{{ $name }}" style="height: {{ $height }};">{!! old($name, $value) !!}</div>
<input type="hidden" name="{{ $name }}" id="input-{{ $name }}" value="{{ old($name, $value) }}">

<div class="mt-3">
    <button type="button" id="toggle-html-{{ $name }}" class="btn btn-sm btn-secondary">Toggle HTML Editor</button>
</div>

<textarea id="html-editor-{{ $name }}" class="form-control mt-2" style="display:none; height: 200px;"></textarea>

@once
    @push('scripts')
        <script src="{{ asset('assets/plugins/quill/quill.js') }}"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quill_{{ $name }} = new Quill('#editor-{{ $name }}', {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            [{ 'header': [1, 2, 3, false] }],
                            [{ 'font': [] }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'script': 'sub' }, { 'script': 'super' }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['blockquote', 'code-block'],
                            ['link', 'image', 'video'],
                            ['clean']
                        ],
                        handlers: {
                            image: function () {
                                const input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');
                                input.click();
                                input.onchange = () => {
                                    const file = input.files[0];
                                    const formData = new FormData();
                                    formData.append('image', file);

                                    fetch('{{ route("admin.quill.upload") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: formData
                                    })
                                        .then(res => res.json())
                                        .then(data => {
                                            const range = quill_{{ $name }}.getSelection();
                                            quill_{{ $name }}.insertEmbed(range.index, 'image', data.url);
                                        })
                                        .catch(err => console.error(err));
                                };
                            }
                        }
                    }
                }
            });

            const input = document.querySelector('#input-{{ $name }}');
            const htmlEditor = document.getElementById('html-editor-{{ $name }}');
            const toggleBtn = document.getElementById('toggle-html-{{ $name }}');

            quill_{{ $name }}.on('text-change', function () {
                const html = quill_{{ $name }}.root.innerHTML;
                input.value = html;
                if (htmlEditor.style.display !== 'none') {
                    htmlEditor.value = html;
                }
            });

            toggleBtn.addEventListener('click', function () {
                if (htmlEditor.style.display === 'none') {
                    htmlEditor.style.display = 'block';
                    htmlEditor.value = quill_{{ $name }}.root.innerHTML;
                } else {
                    htmlEditor.style.display = 'none';
                    quill_{{ $name }}.root.innerHTML = htmlEditor.value;
                    input.value = htmlEditor.value;
                }
            });
        });
    </script>
@endpush

