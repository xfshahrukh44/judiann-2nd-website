<style>

    .hide{
        display: none;
    }

</style>

<section>
    <button class="nav-link active" id="online-tab" type="button"
            onclick="toggleContent('online')">Online
    </button>
    <button class="nav-link" id="onsite-tab" type="button"
            onclick="toggleContent('onsite')">On-Site
    </button>
</section>
<div class="tab-content">
    <div class="" id="Online-box">
        @foreach($online_batches as $batch)
            <div class="scheduleBox">
                <h3>{{ $batch->name }}</h3>
                <h4 class="text-white">TIMINGS</h4>
                {!! get_batch_timings($batch) !!}
                <button class="btn btn-primary btn-register-batch"
                        data-batch-id="{{ $batch->id }}"
                        data-class-type="online">Register Batch
                </button>
            </div>
        @endforeach
    </div>
    <div class="hide" id="OnSite-box">
        @foreach($physical_batches as $batch)
            <div class="scheduleBox">
                <h3>{{ $batch->name }}</h3>
                <h4 class="text-white">TIMINGS</h4>
                {!! get_batch_timings($batch) !!}
                @if($batch->physical_class_type == 'group')
                    <h4 class="text-white">Number of Seats: {{ $batch->number_of_seats }}</h4>
                @endif
                @if(batch_is_full($batch))
                    <h4 class="text-danger">SEATS FULL</h4>
                @endif
                <button class="btn btn-primary btn-register-batch"
                        data-batch-id="{{ $batch->id }}"
                        data-class-type="onsite">Register Batch
                </button>
            </div>
        @endforeach
    </div>
</div>
</div>

<div class="modal fade" id="event_detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="2">
                            <img id="event_img" class="w-100" src="" alt="">
                        </th>
                    </tr>
                    <tr>
                        <th>Course:</th>
                        <td id="event_course"></td>
                    </tr>
                    <tr>
                        <th>Time:</th>
                        <td id="event_time"></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td id="event_description"></td>
                    </tr>
                    <tr>
                        <th>Class Type:</th>
                        <td id="event_class_type"></td>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" id="btn_register_course" class="btn btn-primary" data-event="">Register
                        Course
                    </button>
                    <button type="button" id="btn_seats_full" class="btn btn-danger" data-dismiss="modal">SEATS FULL
                    </button>
                    <button type="button" id="btn_already_bought" class="btn btn-success" data-dismiss="modal">ALREADY
                        BOUGHT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Popper.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function toggleContent(tab) {
        console.log("tab", tab);
        if (tab === 'online') {
            console.log("online")
            document.getElementById("Online-box").style.display = "block";
            document.getElementById("OnSite-box").style.display = "none";
        } else if (tab === 'onsite') {
            document.getElementById("Online-box").style.display = "none";
            document.getElementById("OnSite-box").style.display = "block";
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '.btn-register-batch', function () {
            var batchId = $(this).data('batch-id');
            var classType = $(this).data('class-type');

            $.ajax({
                url: "{{ route("batch.details") }}",
                method: 'GET',
                data: {
                    batch_id: batchId
                },
                success: function (data) {
                    console.log('data', data);

                    $('#event_detail_modal').modal('show');
                    // Update modal content with batch details and show the modal
                    $('#event_course').html(data.course);
                    $('#event_time').html(data.time);
                    $('#event_description').html(data.description);
                    $('#event_img').prop('src', data.img_src);
                    $('#event_class_type').html(classType);
                    $('#event_fees').html('$' + data.fees);

                    if (classType === 'onsite') {
                        $('#event_physical_class_type').html(data.physical_class_type === 'group' ? 'Group' : 'In Person');
                        $('.event_physical_class_type').prop('hidden', false);
                    } else {
                        $('.event_physical_class_type').prop('hidden', true);
                    }

                    // Show appropriate buttons based on batch details
                    $('#btn_register_course').prop('hidden', data.already_bought || data.batch_is_full);
                    $('#btn_seats_full').prop('hidden', !data.batch_is_full || data.already_bought);
                    $('#btn_already_bought').prop('hidden', !data.already_bought);

                    // Set data-event attribute for the "Register Course" button
                    $('#btn_register_course').data('event', {
                        title: data.course,
                        extendedProps: {
                            time: data.time,
                            description: data.description,
                            img_src: data.img_src,
                            class_type: classType,
                            physical_class_type: data.physical_class_type,
                            already_bought: data.already_bought,
                            batch_is_full: data.batch_is_full,
                            fees: data.fees,
                            batchId: data.batch_id
                        }
                    });

                    // Show the event detail modal
                    $('#event_detail_modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log("Ajax error");
                    // Handle error if needed
                    console.log(xhr.responseText);
                }
            });
        });
        $('#btn_register_course').on('click', function () {
            let event = $(this).data('event');
            console.log('EVENT', event.extendedProps);

            //prevent redundant items selection
            if ($('#tr_batch_' + event.extendedProps.batchId).length > 0) {
                $('#event_detail_modal').modal('hide');
                return alert('Item already selected.');
            }

            let login_check = '{{\Illuminate\Support\Facades\Auth::check()}}';
            if (!login_check) {
                $('#event_detail_modal').modal('hide');
                return $('#loginModal').modal('show');
            } else {
                //courses_wrapper
                $('#courses_wrapper').append(`<tr id="tr_batch_` + event.extendedProps.batchId + `">
                                            <input type="hidden" name="batch_ids[]" value="` + event.extendedProps.batchId + `">
                                            <input type="hidden" name="class_types[]" value="` + event.extendedProps.class_type + `">
                                            <input type="hidden" name="physical_class_types[]" value="` + event.extendedProps.physical_class_type + `">
                                            <input type="hidden" name="fees[]" class="input_fees" value="` + event.extendedProps.fees + `">
                                            <input type="hidden" name="time[]" value="` + event.extendedProps.time + `">

                                            <td>
                                                ` + event.title + `
                                            </td>
                                            <td>
                                                $` + event.extendedProps.fees + `
                                            </td>
                                            <td>
                                                <div class="btnCont">
                                                    <span>
                                                        <i class="fas fa-times"></i>
                                                        <input type="radio" class="btn_remove_course" name="" id="" data-batch="` + event.extendedProps.batchId + `">
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>`);

                calculate_total();
                $('#event_detail_modal').modal('hide');
            }
        });
    });

</script>


