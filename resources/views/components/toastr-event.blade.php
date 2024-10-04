<div
    class="fixed bottom-4 md:bottom-8 left-0 right-0 mx-auto px-4 md:px-0 md:left-auto md:right-8 w-full md:w-2/6 z-100 transition duration-200"
    x-data="{ messages: [] }"
    x-init="
        Livewire.on('flashMessage', message => {
            let classType = '';
            let text = '';

            // Check if the message contains the '|' character
            if (message.includes('|')) {
                [classType, text] = message.split('|');
            } else {
                text = message; // Assign the entire message to text if no '|' is present
            }

            let messageId = Date.now(); // Unique identifier for each message
            messages.push({ id: messageId, class: classType, text: text, show: true });

            setTimeout(() => {
                // Remove the message with the specified id from the queue
                messages = messages.filter(msg => msg.id !== messageId);
            }, 7500);
        });
    "
>
    <template x-for="(message, index) in messages" :key="message.id">
        <div
            x-show="message.show"
            class="bg-primary-50 border border-primary-500 shadow-md rounded-lg py-2.5 px-4 mt-2 flex items-center"
        >
            <div class="bg-primary-100 h-8 w-8 rounded-full inline-flex items-center justify-center mr-3">
                <x-icon name="o-exclamation-circle" class="text-primary-500"></x-icon>
            </div>

            <span x-text="message.text"></span>
            <x-icon
                x-on:click="message.show = false"
                name="o-x"
                class="text-gray-500 p-1 w-6 h-6 ml-auto hover:text-gray-700 cursor-pointer"
            ></x-icon>
        </div>
    </template>
</div>
