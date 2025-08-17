<style>
.alert {
  padding: 12px 16px;
  border-radius: 6px;
  margin: 10px 0;
  font-weight: 500;
  position: fixed;
  top: 20px;
  z-index: 1002;
}


.alert-success {
  background: #d1e7dd;
  border: 1px solid #badbcc;
  color: #0f5132;
}


.alert-error {
  background: #f8d7da;
  border: 1px solid #f5c2c7;
  color: #842029;
}
</style>

@if(session('error'))
    <div class="alert alert-error">
        {{Session::get('error')}}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif


<script>
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => el.remove());
  }, 3000);
</script>
