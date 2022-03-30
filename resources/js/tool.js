Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-lite-calendar-tool',
      path: '/nova-lite-calendar-tool',
      component: require('./components/Tool'),
    },
  ]);
})
