db.createUser({
    user: "root",
    pwd: "19ZoLYV7cmFz",
    roles: [
      {
        role: "readWrite",
        db: "shop"
      }
    ]
  });

db.users.insertOne({ email: "abc@abc.com", roles: ['ROLE_ADMIN'], password: "$2y$13$zw7W954wrTqY4ZnX2AcOVuzB93d/RD6fWlzSvCc/1yC543ZrW.VFu" });

  