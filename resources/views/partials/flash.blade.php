@if(session('success'))
    <div class="flash flash-success" style="background: rgba(46, 204, 113, 0.2); color: #2ecc71; padding: 10px; border-radius: var(--radius); margin-bottom: 20px;">
        <i class="ti ti-check"></i> {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="flash flash-info" style="background: rgba(241, 196, 15, 0.2); color: #f1c40f; padding: 10px; border-radius: var(--radius); margin-bottom: 20px;">
        <i class="ti ti-info-circle"></i> {{ session('info') }}
    </div>
@endif

@if(session('error'))
    <div class="flash flash-error" style="background: rgba(231, 76, 60, 0.2); color: #e74c3c; padding: 10px; border-radius: var(--radius); margin-bottom: 20px;">
        <i class="ti ti-alert-triangle"></i> {{ session('error') }}
    </div>
@endif

@if(isset($errors) && $errors->any())
    <div class="flash flash-error" style="background: rgba(231, 76, 60, 0.2); color: #e74c3c; padding: 10px; border-radius: var(--radius); margin-bottom: 20px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
