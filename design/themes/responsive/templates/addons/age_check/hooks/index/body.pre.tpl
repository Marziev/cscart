    {if 'AGECHECK'|fn_get_cookie == null}
        <div class="hidden cm-dialog-auto-open cm-dialog-auto-size" id="open_id" title="Для входа на сайт, подтвердите свой возраст">
            <form name="my_form" action="{""|fn_url}" method="post" class="form-horizontal form-edit">
                <ol class="ty-control-group agecheck-block">
                    <li class="agecheck-li">
                        <label class="ty-control-group__title agecheck-label" for="day">{__("day")}</label>
                        <input id="day"  class="agecheck-c" type="number" name="day" placeholder="ДД" min="1" max="31"  />
                    </li>
                    <li class="agecheck-li">
                        <label class="ty-control-group__title agecheck-label" for="month">{__("month")}</label>
                        <input id="month"  class="agecheck-c" type="number" name="month" placeholder="ММ" min="1" max="12" />
                    </li>
                    <li class="agecheck-li">
                        <label class="ty-control-group__title agecheck-label" for="year">{__("year")}</label>
                        <input id="year"  class="agecheck-c" type="number" name="year" placeholder="ГГГГ" min="1" max="2021" />
                    </li>
                </ol>
                <div class="buttons-container agecheck-buttons">
                    <div class="">
                        {include file="buttons/button.tpl" but_name="dispatch[test.test]" but_text=__("submit") but_role="submit" but_meta="ty-btn__primary ty-btn__big cm-form-dialog-closer ty-btn"}
                    </div>
                </div>
            </form>
        </div>
    {elseif 'AGECHECK'|fn_get_cookie == "deny"}
        <div class="hidden cm-dialog-auto-open "  title="Уведомления">
            <p class="agecheck-center">
                Извините, но Вы слишком молоды для просмотра данной страницы
            </p>
        </div>
    {/if}