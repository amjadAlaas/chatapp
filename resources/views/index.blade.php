<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="pt-0 px-0 border-b border-gray-200">
            <div class="p-2 text-white bg-gray-900 ">
                {{ $receiver->name }}
            </div>
            <div class="msgs px-2">


                @foreach ($messages as $message)
                    <div
                        class="msg-container flex items-center {{ $message->sender->id === $sender->id ? ' justify-end ' : 'flex-start' }} ">
                        <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                            class="object-cover h-8 w-8 rounded-full" alt="profile" />
                        <div
                            class="{{ $message->sender->id === $sender->id ? ' px-4 bg-indigo-600  rounded-xl order-first ' : ' order-last bg-gray-400 rounded-xl ' }} my-3 mr-2 ml-2 py-3 px-3 text-white">
                            <span class="message">{{ $message->message }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('message.store', $receiver->id) }}" method="post"
                class="flex fixed bottom-0 w-full  lg:w-3/4 right-5 ml-4 px-3 mt-2">
                @csrf
                <input type="text" name="message" id="message"
                    class="rounded-md p-2 ml-2 block w-full border-indigo-600">
                <input type="submit" id="send" value="send"
                    class="cursor-pointer absolute right-0 border-1 border-indigo-600 bg-indigo-600 p-2 rounded-xl text-white block">
            </form>
        </div>
    </div>
</x-app-layout>
@include('script')
{{--
    @if ($message->sender->id === $sender->id)
        <p class="bg-red-300">You ({{ $sender->name }}) sent a message to {{ $receiver->name }}:</p>
    @else
        <p>{{ $sender->name }} sent a message to you ({{ $receiver->name }}):</p>
    @endif
<p>{{ $message->message }}</p>
--}}
