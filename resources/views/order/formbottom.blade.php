<button name="add" id="add" class="button btn-primary is-primary" title="Add new item">+ Pridať riadok</button>
<div class="field pull-right">

    Spolu <input  type="text" class="sub_total input" name="sub_total" id="sub_total" readonly="true">

    Daň <input  type="text" class="tax input" name="tax" id="tax">

    Celkom <input  type="text" class="tax_total input" name="tax_total" readonly="true">

</div>
</div>

<div style="margin-top: 25px; margin-bottom: 60px" class="btn-group pull-right">
    <button type="submit" name="order_send" value="0" class="btn btn-primary">Uložiť</button>
    <button type="submit" name="order_send" value="1" class="btn btn-info">Uložiť a odoslať</button>
    <a href="{{ url()->previous() }}" class="btn btn-default">Zrušiť</a>
</div>

