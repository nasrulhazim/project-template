@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.magic('tooltip', el => message => {
                let instance = tippy(el, {
                    content: message,
                    trigger: 'manual'
                })

                instance.show()

                setTimeout(() => {
                    instance.hide()

                    setTimeout(() => instance.destroy(), 150)
                }, 2000)
            })

            Alpine.directive('tooltip', (el, {
                expression
            }) => {
                tippy(el, {
                    content: expression
                })
            })
        })
    </script>
@endpush
