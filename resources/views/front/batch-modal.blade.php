<style>
    .hide {
        display: none;
    }

    .online-btn-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
    }

    #Online-box tr h6 {
        font-family: unset
    }

    #OnSite-box tr h6 {
        font-family: unset
    }

    #Online-box {
        overflow-y: auto;
        max-height: 500px;
    }

    #OnSite-box {
        overflow-y: auto;
        max-height: 500px;
    }

    .thead {
        text-align: center;
    }

    .online-tab {
        color: #fff;
        background-color: #e2571c;
        border-color: #e2571c;
    }

    .online-tab:hover {
        color: #e2571c;
        background-color: #fff;
        border-color: #fff;
    }

    .online-tab:focus {
        outline: none;
        color: #e2571c;
        background-color: #fff;
        border-color: #fff;
    }

    .onsite-tab {
        color: #fff;
        background-color: #e2571c;
        border-color: #e2571c;
    }

    .onsite-tab:hover {
        color: #e2571c;
        background-color: #fff;
        border-color: #fff;
    }

    .onsite-tab:focus {
        color: #e2571c;
        background-color: #fff;
        border-color: #fff;
    }

    .batch-detail:focus {
        outline: none;
        color: #fff;
        background-color: #e2571c;
        border-color: #e2571c;
    }

    .batch-detail:hover {
        color: #fff;
        background-color: #e2571c;
        border-color: #e2571c;
    }

    .batch-detail {
        color: #e2571c;
        background-color: #fff;
        border-color: #fff;
    }
</style>

<section class="online-btn-box mb-4">
    <button class="nav-link btn btn-primary online-tab" id="online-tab" type="button"
            onclick="toggleContent('online')">Online
    </button>
    <button class="nav-link btn btn-primary onsite-tab" id="onsite-tab" type="button"
            onclick="toggleContent('onsite')">On-Site
    </button>
</section>

<div class="tab-content">
    <div class="tab-pane active" id="Online-box">
        <table class="table">
            <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Timings</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($onlineBatches))
                @forelse($onlineBatches as $index => $onlineBatch)
                    <tr class="batch-item">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $onlineBatch->name }}</td>
                        <td>{!! get_batch_timings_by_id($onlineBatch->id) !!}</td>
                        <td>${{ $onlineBatch['course']['fees'] }}</td>
                        <td>
                            <button class="btn btn-primary btn-register-batch batch-detail btn_register_course"
                                    data-batch-id="{{ $onlineBatch->id }}"
                                    data-class-type="{{ $onlineBatch->is_physical }}"
                                    data-batch-name="{{ $onlineBatch->name }}"
                                    data-course-price="{{ $onlineBatch['course']['fees'] }}">Register Batch
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="batch-item">
                        <td colspan="4"><h2>No Batches Available</h2></td>
                    </tr>
                @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div class="tab-pane hide" id="OnSite-box">
        <table class="table">
            <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Timings</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($physicalBatches))
                @forelse($physicalBatches as $index => $physicalBatch)
                    <tr class="batch-item">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $physicalBatch->name }}</td>
                        <td>{!! get_batch_timings_by_id($physicalBatch->id) !!}</td>
                        <td>${{ $physicalBatch['course']['fees'] }}</td>
                        <td>
                            <button class="btn btn-primary btn-register-batch batch-detail btn_register_course"
                                    data-batch-id="{{ $physicalBatch->id }}"
                                    data-class-type="{{ $physicalBatch->is_physical }}"
                                    data-batch-name="{{ $physicalBatch->name }}"
                                    data-course-price="{{ $physicalBatch['course']['fees'] }}">Register Batch
                            </button>
                            {{--<button type="button" id="btn_seats_full" class="btn btn-danger" data-dismiss="modal">SEATS FULL
                            </button>
                            <button type="button" id="btn_already_bought" class="btn btn-success" data-dismiss="modal">ALREADY
                                BOUGHT
                            </button>--}}
                        </td>
                    </tr>
                @empty
                    <tr class="batch-item">
                        <td colspan="4"><h2>No Batches Available</h2></td>
                    </tr>
                @endforelse
            @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
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
