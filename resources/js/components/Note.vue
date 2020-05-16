<template>
  <div class ="photo">
    <figure class="photo__wrapper">
      日付 {{ item.record }}
      起床時間{{ item.wake_uptime }}
      就寝時間{{ item.bedtime }}
      午前中の気分{{ item.am_image }}
      午後の気分{{ item.pm_image }}
      夜の気分{{ item.night_image }}
      一言{{ item.body }}
    </figure>
    <RouterLink
      class="photo__overlay"
      :to="`/notes/${item.id}`"
    >
    </RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>