<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="previewModalBody">
                <p class="text-muted">Loading...</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalTitle = document.getElementById('previewModalLabel');
            const modalBody = document.getElementById('previewModalBody');

            document.querySelectorAll('.preview-button').forEach(button => {
                button.addEventListener('click', () => {
                    const title = button.getAttribute('data-title') || 'Preview';
                    const id = button.getAttribute('data-id');
                    const contentId = button.getAttribute('data-preview-id') || `${id}`;
                    const content = document.getElementById(contentId)?.innerHTML || '<p>No content</p>';

                    modalTitle.textContent = `Preview: ${title}`;
                    modalBody.innerHTML = content;
                });
            });
        });
    </script>
@endpush
