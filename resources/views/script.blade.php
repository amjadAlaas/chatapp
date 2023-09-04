<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#send').on("click", function(e) {
            e.preventDefault();
            csrfToken = $('meta[name="csrf-token"]').attr('content');
            var sender_id = $('{{ $sender->id }}').val();
            var receiver_id = $('{{ $receiver->id }}').val();
            var message = $('#message').val();
            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                data: {
                    sender_id: sender_id,
                    receiver_id: receiver_id,
                    message: message,
                },
                success: function(res) {
                    if (res.code === 200) {
                        console.log("message sent");
                        // $('.msgs').append(
                        //     `<div class="flex items-center {{ $message->sender_id == $sender->id ? ' justify-end ' : 'flex-start' }} ">
                        //         <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full" alt="" />
                        //         <div class="{{ $message->sender_id == $sender->id ? ' px-4 bg-indigo-600  rounded-tr-3xl rounded-bl-3xl order-first ' : ' order-last bg-gray-400 rounded-br-3xl rounded-tl-3xl ' }} my-3 mr-2 ml-2 py-3 px-3 text-white">
                        //             <span class="message">${res.data.message}</span>
                        //         </div>
                        //     </div>`
                        // );
                    }
                },
                error: function(err) {
                    // Handle any errors that occur during the AJAX request
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        console.log(value);
                        $(".errors-container").append(
                            `<li class='bg-red-500 text-white my-2 p-2 rounded'>${value}</li>`
                        );
                    });
                },
            });
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('d85e52ce4e98e9edb859', {
                cluster: 'eu'
            });
            var channel = pusher.subscribe('lastchatapp');
            channel.bind('send-message', function(receiverData) {
                $('.msgs').append(
                    `<div   class="flex items-center {{ $message->sender->id == $sender->id ? ' justify-end ' : 'flex-start' }} ">
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full" alt="" />
                            <div class="{{ $message->sender->id == $sender->id ? ' px-4 bg-indigo-600  rounded-xl roundedxl order-first ' : ' order-last bg-gray-400 rounded-xl ' }} my-3 mr-2 ml-2 py-3 px-3 text-white">
                                <span class="message">${receiverData.message}</span>
                            </div>
                    </div>`
                );
                //   alert(JSON.stringify(data));
            });
        });
    });
</script>
