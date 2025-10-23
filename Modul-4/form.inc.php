<form method="post" action="form.php">
    <div class="form-group">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" 
               value="<?php echo $form_data['surname']; ?>" 
               required>
        <?php if (isset($errors['surname'])): ?>
            <div class="error"><?php echo $errors['surname']; ?></div>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" 
               value="<?php echo $form_data['email']; ?>" 
               required>
        <?php if (isset($errors['email'])): ?>
            <div class="error"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" 
               value="<?php echo $form_data['phone']; ?>" 
               required>
        <?php if (isset($errors['phone'])): ?>
            <div class="error"><?php echo $errors['phone']; ?></div>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" 
               value="<?php echo $form_data['age']; ?>" 
               min="1" max="120" required>
        <?php if (isset($errors['age'])): ?>
            <div class="error"><?php echo $errors['age']; ?></div>
        <?php endif; ?>
    </div>
    
    <button type="submit" class="submit-btn">Submit</button>
</form>