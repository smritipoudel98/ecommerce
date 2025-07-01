<x-mail::message>
# New Contact Message

You've received a message from your contact form.

**Name:** {{ $name }}  
**Email:** {{ $email }}  
**Phone:** {{ $phone }}  
**Message:**  
{{ $message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
