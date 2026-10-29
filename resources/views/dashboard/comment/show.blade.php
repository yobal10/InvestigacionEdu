<div>
    <p><span class="font-weight-bold">Comentarista: </span><span>{{ $comment->user ? $comment->user->name : $comment->name }}</span> <span class="badge bg-{{ $comment->user ? "success" : "warning" }}">{{ $comment->user ? "Usuario" : "Invitado" }}</span></p>
    <p><span class="font-weight-bold">Email: </span><span>{{ $comment->user ? $comment->user->email : $comment->email }}</span></p>
    <p><span class="font-weight-bold">Comentario: </span><span>{{ $comment->message }}</span></p>
    <p><span class="font-weight-bold">Tipo de Comentario: </span><span class="badge bg-info">{{ !$comment->parent_id ? "Comentario" : "Respuesta" }}</span></p>
    <p><span class="font-weight-bold">Post: </span><span>{{ $comment->post->title }}</span></p>
    <p><span class="font-weight-bold">Estado del Post: </span><span class="badge bg-{{ $comment->post->status ? "success" : "danger" }}">{{ $comment->post->status ? "Publicado" : "Borrador" }}</span></p>
    <p><span class="font-weight-bold">Enviado el: </span><span>{{ $comment->created_at->format("d F, Y h:i:s A") }}</span></p>
</div>
