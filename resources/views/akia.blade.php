<select id="customer_category">
    <option value="">select</option>
    @foreach($customer as $list)
      <option value="{{$list->id}}">{{$list->category_name}}</option>
    @endforeach
</select>