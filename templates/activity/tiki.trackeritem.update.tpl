{activityframe activity=$activity heading="{tr _0=$activity.user|userlink}%0 modified a tracker item{/tr}"}
    <p>{object_link type=$activity.type id=$activity.object} in {object_link type=tracker id=$activity.trackerId}</p>
    {if is_array($activity.aggregate)}
    <small>{$activity.aggregate.user|userlink}</small>
    {/if}
{/activityframe}
