<div class="ty-feature">
    <h1 class="ty-mainbox-title">  
       {__("head_of_department")} : {$h_department.firstname} {$h_department.lastname}               
    </h1>
    {if $department_data.main_pair}
        <div class="ty-feature__image">
            {include file="common/image.tpl" images=$department_data.main_pair}
        </div>
    {/if}
    <div class="ty-feature__description ty-wysiwyg-content">
        {$department_data.description nofilter}
    </div>
</div>

{if $department_data['staff_ids']}
    <div class="ty-feature__description ty-wysiwyg-content">
        <ul>
            <h3 class="ty-product-block-title">{__("employee_department")}:</h3>
            {foreach from=$department_data['staff_ids'] item=num}
                {foreach from=$staffs item=foo}
                    {if $foo.user_id == $num}
                        <li class="ty-subheader">{$foo.firstname} {$foo.lastname}</li>    
                    {/if}  
                {/foreach}          
            {/foreach}
        <ul>
    </div>
{else}
    <p class="ty-no-items">{__("text_no_products")}</p>
{/if}
