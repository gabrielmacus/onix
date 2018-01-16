{extends "demo.tpl"}

{block "content"}

    {if !empty($results)}
<table>
    <thead>
         {foreach $results["keys"] val}
             <th>{$lang[$val]}</th>
         {/foreach}
    </thead>


    <tbody>
      {foreach $results["values"] val}
          <tr>
              {foreach $val prop}

                  <td>{$prop}</td>

              {/foreach}

          </tr>
       {/foreach}
    </tbody>

</table>
    {else}

        <div class="no-results">

            <p>
                {$lang["noresults"]}
            </p>

        </div>

    {/if}

{/block}
