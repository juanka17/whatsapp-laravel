<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div>
        <h1 class="text-4xl font-bold mb-4">¡Bienvenido al componente Livewire!</h1>
        <form wire:submit.prevent="sendMessage">
            <div class="form-group">
                <label for="to">To: 3007945983</label>
                <input type="text" class="form-control" id="to" wire:model="to">
            </div>

            {{--             <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" wire:model="message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button> --}}

            <button type="button" class="btn btn-primary" id="btnGestion" 
            wire:loading.remove wire:click='enviarmensaje'>send</button>

            
        </form>
    </div>
</div>
